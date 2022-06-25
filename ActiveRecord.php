<?php

namespace MySql;

use PDO;

class ActiveRecord
{
    private PDO $link;
    public int $id;
    public string $chatUser;
    public string $UserPassword;

    public function __construct()
    {
        $this->connect();
    }

    private function connect(): void
    {
        $dsn = 'mysql:host=localhost;dbname=PDO_MySql';
        $this->link = new PDO($dsn, 'admin', 'password');
    }

    public function create() : void
    {
        $this->execute("insert into PHPUsers values (default, '$this->chatUser', '$this->UserPassword')");
    }

    public function read(): ?array
    {
        return $this->query("select* from PHPUsers", [], ActiveRecord::class);
    }

    public function searchByID(): ?array
    {
        return $this->query("SELECT* from PHPUsers where id = $this->id", [], ActiveRecord::class);
    }

    public function searchByValue(): ?array
    {
        if ($this->chatUser !== "")
            return $this->query("SELECT* from PHPUsers where chatUser = '$this->chatUser'", [], ActiveRecord::class);
        elseif ($this->UserPassword !== "")
            return $this->query("SELECT* from PHPUsers where UserPassword = '$this->UserPassword'", [], ActiveRecord::class);
        else
            return $Users = $this->query("select* from PHPUsers", [], ActiveRecord::class);
    }

    public function delete(): array
    {
        $this->execute("DELETE from PHPUsers where id = $this->id");
        return $this->read();
    }

    private function execute($sql) : void
    {
        $sth = $this->link->prepare($sql);
        $sth->execute();

        $this->chatUser = '';
        $this->UserPassword = '';
    }

    private function query(string $sql, array $params, string $className = 'stdClass'): ?array
    {
        $sth = $this->link->prepare($sql);
        $result = $sth->execute($params);

        $this->chatUser = '';
        $this->UserPassword = '';

        if (false === $result) {
            return null;
        }

        return $sth->fetchAll(\PDO::FETCH_CLASS, $className);
    }
}