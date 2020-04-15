<?php
declare(strict_types=1);
namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\InterviewRepository")
 */
class Interview
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=40)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=150)
     */
    private $description;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Question", mappedBy="Interview")
     */
    private $questions;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\User", mappedBy="quizzes_completed")
     */
    private $users_completed;

    /**
     * @ORM\Column(type="boolean")
     */
    private $EditorsChoice;


    public function __construct()
    {
        $this->questions = new ArrayCollection();
        $this->users_completed = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection|Question[]
     */
    public function getQuestions(): Collection
    {
        return $this->questions;
    }

    public function addQuestion(Question $question): self
    {
        if (!$this->questions->contains($question)) {
            $this->questions[] = $question;
            $question->addInterview($this);
        }

        return $this;
    }

    public function removeQuestion(Question $question): self
    {
        if ($this->questions->contains($question)) {
            $this->questions->removeElement($question);
            $question->removeInterview($this);
        }

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getUsersCompleted(): Collection
    {
        return $this->users_completed;
    }

    public function addUsersCompleted(User $usersCompleted): self
    {
        if (!$this->users_completed->contains($usersCompleted)) {
            $this->users_completed[] = $usersCompleted;
            $usersCompleted->addQuizzesCompleted($this);
        }

        return $this;
    }

    public function removeUsersCompleted(User $usersCompleted): self
    {
        if ($this->users_completed->contains($usersCompleted)) {
            $this->users_completed->removeElement($usersCompleted);
            $usersCompleted->removeQuizzesCompleted($this);
        }

        return $this;
    }

    public function getEditorsChoice(): ?bool
    {
        return $this->EditorsChoice;
    }

    public function setEditorsChoice(bool $EditorsChoice): self
    {
        $this->EditorsChoice = $EditorsChoice;

        return $this;
    }

}