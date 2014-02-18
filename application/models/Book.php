<?php

/**
 * @Entity
 * @Table(name="books")
 */
class Model_Book
{
    /**
     * @Id @Column(type="integer")
     * @GeneratedValue(strategy="AUTO")
     */
    private $id;

    /** @Column(type="string") */
    private $name;

    public function setName($string)
    {
        $this->name = $string;
        return true;
    }
}