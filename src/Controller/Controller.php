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
            if (empty($value)) {
                continue;
            }
            if (!Regex::valid($value)) {
                continue;
            }
            $gets[$key] = $value;
        }

        return $gets;
    }

    public function post(): array
    {
        $posts = [];
        foreach ($_POST as $key => $value) {
            if (empty($value)) {
                continue;
            }
            if (!Regex::valid($value)) {
                continue;
            }
            $posts[$key] = $value;
        }

        return $posts;
    }

    public function show(): void
    {
        throw new \DomainException(translate("Necessary extendens this method"));
    }

    public function view(): void
    {
        throw new \DomainException(translate("Necessary extendens this method"));
    }

    public function edit(): void
    {
        throw new \DomainException(translate("Necessary extendens this method"));
    }

    public function store(): void
    {
        throw new \DomainException(translate("Necessary extendens this method"));
    }

    public function delete(): void
    {
        throw new \DomainException(translate("Necessary extendens this method"));
    }
}