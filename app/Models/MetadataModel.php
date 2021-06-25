<?php

namespace App\Models;

class MetadataModel
{
    private $title;
    private $creator;
    private $description;
    private $date;
    private $type;
    private $format;
    private $identifier;
    private $source;
    private $language;
    private $publisher;
    private $subject;

    public function __construct() {}

    public function setTitle($title)
    {
        $this->title = $title;
    }
    public function getTitle()
    {
        return $this->title;
    }

    public function setCreator($creator)
    {
        $this->creator = $creator;
    }
    public function getCreator()
    {
        return $this->creator;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }
    public function getDescription()
    {
        return $this->description;
    }

    public function setDate($date)
    {
        $this->date = $date;
    }
    public function getDate()
    {
        return $this->date;
    }

    public function setType($type)
    {
        $this->type = $type;
    }
    public function getType()
    {
        return $this->type;
    }

    public function setFormat($format)
    {
        $this->format = $format;
    }
    public function getFormat()
    {
        return $this->format;
    }

    public function setIdentifier($identifier)
    {
        $this->identifier = $identifier;
    }
    public function getIdentifier()
    {
        return $this->identifier;
    }

    public function setSource($source)
    {
        $this->source = $source;
    }
    public function getSource()
    {
        return $this->source;
    }

    public function setLanguage($language)
    {
        $this->language = $language;
    }
    public function getLanguage()
    {
        return $this->language;
    }

    public function setPublisher($publisher)
    {
        $this->publisher = $publisher;
    }
    public function getPublisher()
    {
        return $this->publisher;
    }

    public function setSubject($subject)
    {
        $this->subject = $subject;
    }
    public function getSubject()
    {
        return $this->subject;
    }

    public function toArray()
    {
        return array(
            'Title' => $this->getTitle(),
            'Creator' => $this->getCreator(),
            'Description' => $this->getDescription(),
            'Date' => $this->getDate(),
            'Type' => $this->getType(),
            'Format' => $this->getFormat(),
            'Identifier' => $this->getIdentifier(),
            'Source' => $this->getSource(),
            'Language' => $this->getLanguage(),
            'Publisher' => $this->getPublisher(),
            'Subject' => $this->getSubject()
        );
    }

}