<?php

namespace Project\Models\Users;

use Project\Models\AbstractActiveRecord;
use Project\Services\Db;
use Project\Exceptions\UserException;
use Project\Exceptions\DbException;

class User extends AbstractActiveRecord
{
    protected $email;
    protected $role;
    protected $authToken;
    protected $passwordHash;
    protected $camelCaseName;

    public function getEmail(): string
    {
        return $this->email;
    }
    public function getRole(): string
    {
        return $this->role;
    }
    public function getAuthToken(): string
    {
        return $this->authToken;
    }

    public static function createRegistrUser(array $data): ?self
    {
        $userData = self::prepareUserData($data);
        $columns = '`email`, `password_hash`, `auth_token`, `role`';
        $values = ':email, :password, :token, :role';

        if (self::getByEmail($userData['email'])) {
            throw new UserException('Пользователь с таким e-mail уже существует');
        }
        if (!self::createRecord($columns, $values, $userData)) {
            throw new DbException('Ошибка регистрации пользователя');
        }
        return self::getByEmail($userData['email']);
    }

    public static function checkAuthUser(array $data)
    {
        $userData = self::prepareUserData($data);
        $user = User::getByEmail($userData['email']);
        if (!$user) {
            throw new UserException('Такого пользователя не существует');
        }
        if (!password_verify($data['password'], $user->getHash())) {
            throw new UserException('Пароль введен неверно');
        }
        
        return $user->setAuthToken($userData['token']) ? $user : false;
    }

    protected static function getByEmail(string $email): ?self
    {
        $db = Db::getInstanse();
        $entities = $db->query(
            'SELECT * FROM `' . static::getTableName() . '` WHERE email = :email;',
            [':email' => $email],
            static::class
        );

        return $entities ? $entities[0] : null;
    }
    
    protected static function getTableName(): string
    {
        return 'users';
    }

    protected static function prepareUserData(array $data): array
    {
        $result = [];

        $email = strtolower(trim($data['email']));
        if (empty($email)) {
            throw new UserException('Введите емейл');
        }
        if (!preg_match('/\w{3,}@[a-z]{3}\.\w+/', $email)) {
            throw new UserException('Введите корректный емейл');
        }
        $result['email'] = $email;

        if (!preg_match('/(?=.*[!]).{6,}/', $data['password'])) {
            throw new UserException('Пароль должен состоять как минимум из 6-ти символов и содержать "!"');
        }
        $password = password_hash($data['password'], PASSWORD_DEFAULT);
        $result['password'] = $password;

        $result['token'] = sha1(random_bytes(100)).sha1(random_bytes(100));

        if (isset($data['role'])) {
            if (empty($data['role'])) {
                throw new UserException('Выберите должность');
            }
            $result['role'] = $data['role'];
        }
        return $result;
    }

    protected function setAuthToken(string $token): bool
    {
        $this->authToken = $token;
        return $this->updateById($this->getId(), 'auth_token', $token);
    }

    protected function getHash(): string
    {
        return $this->passwordHash;
    }
}
