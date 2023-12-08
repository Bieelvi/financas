<?php 

namespace Financas\Controller;

use Doctrine\ORM\EntityManager;
use Financas\Helper\Regex;

abstract class Controller
{
    public function __construct(protected EntityManager $em)
    {
        $this->em = $em;
    }

    public function get(): array
    {
        $gets = [];
        foreach ($_GET as $key => $value) {            
            if (!empty($value) && Regex::valid($value)) {
                $gets[$key] = $value;
            }
        }

        return $gets;
    }

    public function post(): array
    {
        $posts = [];
        foreach ($_POST as $key => $value) {
            if (!empty($value) && Regex::valid($value)) {
                $posts[$key] = $value;
            }
        }

        return $posts;
    }

    public function show(): void
    {
        throw new \DomainException('Necessário extender este método');
    }

    public function view(): void
    {
        throw new \DomainException('Necessário extender este método');
    }

    public function edit(): void
    {
        throw new \DomainException('Necessário extender este método');
    }

    public function store(): void
    {
        throw new \DomainException('Necessário extender este método');
    }

    public function delete(): void
    {
        throw new \DomainException('Necessário extender este método');
    }
}