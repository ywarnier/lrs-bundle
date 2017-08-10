<?php
/* For licensing terms, see /license.txt */

namespace XApi\LrsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Statement
 *
 * @ORM\Table(name="lrs_attachment", indexes={@ORM\Index(name="idx_lrs_attachment", columns={"id"})})
 * @ORM\Entity
 */
class Attachment
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
     * @ORM\Column(name="usage_type", type="text", nullable=true)
     */
    private $usageType;

    /**
     * @var string
     *
     * @ORM\Column(name="content_type", type="text", nullable=true)
     */
    private $contentType;

    /**
     * @var string
     *
     * @ORM\Column(name="length", type="text", nullable=true)
     */
    private $length;

    /**
     * @var string
     *
     * @ORM\Column(name="sha2", type="text", nullable=true)
     */
    private $sha2;

    /**
     * @var string
     *
     * @ORM\Column(name="display", type="text", nullable=true)
     */
    private $display;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="file_url", type="text", nullable=true)
     */
    private $fileUrl;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text", nullable=true)
     */
    private $content;

    /**
     * @param IRI              $usageType   The type of usage of this attachment
     * @param string           $contentType The content type of the attachment
     * @param int              $length      The length of the attachment data in octets
     * @param string           $sha2        The SHA-2 hash of the attachment data
     * @param LanguageMap      $display     Localized display name (title)
     * @param LanguageMap|null $description Localized description
     * @param IRL|null         $fileUrl     An IRL at which the attachment data can be retrieved
     * @param string|null      $content     The raw attachment content, please note that the content is not validated against
     *                                      the given SHA-2 hash
     */
    public function __construct(IRI $usageType, $contentType, $length, $sha2, LanguageMap $display, LanguageMap $description = null, IRL $fileUrl = null, $content = null)
    {
        if (null === $fileUrl && null === $content) {
            throw new \InvalidArgumentException('An attachment cannot be created without a file URL or raw content data.');
        }

        $this->usageType = $usageType;
        $this->contentType = $contentType;
        $this->length = $length;
        $this->sha2 = $sha2;
        $this->display = $display;
        $this->description = $description;
        $this->fileUrl = $fileUrl;
        $this->content = $content;
    }

    /**
     * @return string|IRI
     */
    public function getUsageType()
    {
        return $this->usageType;
    }

    /**
     * @return string
     */
    public function getContentType()
    {
        return $this->contentType;
    }

    /**
     * @return int|string
     */
    public function getLength()
    {
        return $this->length;
    }

    /**
     * @return string
     */
    public function getSha2()
    {
        return $this->sha2;
    }

    /**
     * @return string|LanguageMap
     */
    public function getDisplay()
    {
        return $this->display;
    }

    /**
     * @return null|string|LanguageMap
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return null|string|IRL
     */
    public function getFileUrl()
    {
        return $this->fileUrl;
    }

    /**
     * @return null|string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param Attachment $attachment
     * @return bool
     */
    public function equals(Attachment $attachment)
    {
        if (!$this->usageType->equals($attachment->usageType)) {
            return false;
        }

        if ($this->contentType !== $attachment->contentType) {
            return false;
        }

        if ($this->length !== $attachment->length) {
            return false;
        }

        if ($this->sha2 !== $attachment->sha2) {
            return false;
        }

        if (!$this->display->equals($attachment->display)) {
            return false;
        }

        if (null !== $this->description xor null !== $attachment->description) {
            return false;
        }

        if (null !== $this->description && null !== $attachment->description && !$this->description->equals($attachment->description)) {
            return false;
        }

        if (null !== $this->fileUrl xor null !== $attachment->fileUrl) {
            return false;
        }

        if (null !== $this->fileUrl && null !== $attachment->fileUrl && !$this->fileUrl->equals($attachment->fileUrl)) {
            return false;
        }

        return true;
    }
}
