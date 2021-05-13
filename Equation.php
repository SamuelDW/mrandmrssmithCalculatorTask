<?php

declare(strict_types=1);

namespace App\Entity;


use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

class Equation
{
    use TimestampableEntity;
    /**
     * @var int
     *
     * @ORM\Column(name="intEquationId")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\Id
     *
     * @JMS\Type("integer)
     */
    private int $id;

    /**
     * @var string
     *
     * @ORM\Column(name="strEquation")
     *
     * @Assert\NotNull()
     */
    private string $equation;

    /**
     * @var EquationCategory
     *
     * @ORM\ManyToOne(targetEntity="App/Entity/EquationCategory")
     * @ORM\JoinColumn(name="intEquationCategoryId", referencedColumnName="intEquationCategoryId")
     *
     */
    private EquationCategory $equationCategory;

    /**
     * @var string
     *
     * @ORM\Column(name="strEquationHandle")
     *
     * @Assert\NotNull
     */
    private string $equationHandle;

    /**
     * Equation constructor.
     *
     * @param string $equation
     * @param EquationCategory $category
     * @param string $equationHandle
     */
    public function __construct(string $equation, EquationCategory $category, string $equationHandle)
    {

    }
}