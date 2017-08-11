<?php
/* For licensing terms, see /license.txt */

namespace XApi\LrsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * An {@link Actor Actor's} outcome related to the {@link Statement} in which
 * it is included.
 *
 * @ORM\Table(name="lrs_result", indexes={@ORM\Index(name="idx_lrs_result", columns={"id"})})
 * @ORM\Entity
 */
final class Result
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="score", type="text", nullable=true)
     */
    private $score;

    /**
     * @var string
     *
     * @ORM\Column(name="success", type="text", nullable=true)
     */
    private $success;

    /**
     * @var string
     *
     * @ORM\Column(name="completion", type="text", nullable=true)
     */
    private $completion;

    /**
     * @var string
     *
     * @ORM\Column(name="response", type="text", nullable=true)
     */
    private $response;

    /**
     * @var string
     *
     * @ORM\Column(name="duration", type="text", nullable=true)
     */
    private $duration;

    /**
     * @ORM\ManyToMany(targetEntity="XApi\LrsBundle\Entity\Extensions")
     * @ORM\JoinTable(name="lrs_result_rel_extensions",
     *      joinColumns={@ORM\JoinColumn(name="result_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="extension_id", referencedColumnName="id")}
     * )
     */
    //protected $extensions;

    /**
     * @param Score|null      $score
     * @param bool|null       $success
     * @param bool|null       $completion
     * @param string|null     $response
     * @param string|null     $duration
     * @param Extensions|null $extensions
     */
    public function __construct(Score $score = null, $success = null, $completion = null, $response = null, $duration = null, Extensions $extensions = null)
    {
        $this->score = $score;
        $this->success = $success;
        $this->completion = $completion;
        $this->response = $response;
        $this->duration = $duration;
        $this->extensions = $extensions;
    }

    public function withScore(Score $score = null)
    {
        $result = clone $this;
        $result->score = $score;

        return $result;
    }

    /**
     * @param bool|null $success
     *
     * @return Result
     */
    public function withSuccess($success)
    {
        $result = clone $this;
        $result->success = $success;

        return $result;
    }

    /**
     * @param bool|null $completion
     *
     * @return Result
     */
    public function withCompletion($completion)
    {
        $result = clone $this;
        $result->completion = $completion;

        return $result;
    }

    /**
     * @param string|null $response
     *
     * @return Result
     */
    public function withResponse($response)
    {
        $result = clone $this;
        $result->response = $response;

        return $result;
    }

    /**
     * @param string|null $duration
     *
     * @return Result
     */
    public function withDuration($duration)
    {
        $result = clone $this;
        $result->duration = $duration;

        return $result;
    }

    public function withExtensions(Extensions $extensions = null)
    {
        $result = clone $this;
        $result->extensions = $extensions;

        return $result;
    }

    /**
     * Returns the user's score.
     *
     * @return Score The score
     */
    public function getScore()
    {
        return $this->score;
    }

    /**
     * Returns whether or not the user finished a task successfully.
     *
     * @return bool True if the user finished an exercise successfully, false
     *              otherwise
     */
    public function getSuccess()
    {
        return $this->success;
    }

    /**
     * Returns the completion status.
     *
     * @return bool $completion True, if the Activity was completed, false
     *                          otherwise
     */
    public function getCompletion()
    {
        return $this->completion;
    }

    /**
     * Returns the response.
     *
     * @return string The response
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * Returns the period of time over which the Activity was performed.
     *
     * @return string The duration
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * Returns the extensions associated with the result.
     *
     * @return Extensions|null The extensions
     */
    public function getExtensions()
    {
        return $this->extensions;
    }

    /**
     * Checks if another result is equal.
     *
     * Two results are equal if and only if all of their properties are equal.
     *
     * @param Result $result The result to compare with
     *
     * @return bool True if the results are equal, false otherwise
     */
    public function equals(Result $result)
    {
        if (null !== $this->score xor null !== $result->score) {
            return false;
        }

        if (null !== $this->score && !$this->score->equals($result->score)) {
            return false;
        }

        if ($this->success !== $result->success) {
            return false;
        }

        if ($this->completion !== $result->completion) {
            return false;
        }

        if ($this->response !== $result->response) {
            return false;
        }

        if ($this->duration !== $result->duration) {
            return false;
        }

        if (null !== $this->extensions xor null !== $result->extensions) {
            return false;
        }

        if (null !== $this->extensions && null !== $result->extensions && !$this->extensions->equals($result->extensions)) {
            return false;
        }

        return true;
    }
}
