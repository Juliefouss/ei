<?php

namespace App\Service;

use App\Entity\Photo;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class PhotoUploader
{

    private ParameterBagInterface $parameterBag;

    /**
     * PhotoUploader constructor.
     * @param ParameterBagInterface $parameterBag
     */
    public function __construct(ParameterBagInterface $parameterBag)
    {
        $this->parameterBag = $parameterBag;
    }

    public function uploadPhoto(FormInterface $photoField) : ?Photo
    {
        $imageFile = $photoField->get('image')->getData();
        if ($imageFile) {
            $originalFilename = pathinfo($imageFile->getClientOriginalName(), PATHINFO_FILENAME);
            // this is needed to safely include the file name as part of the URL
            $safeFilename = transliterator_transliterate('Any-Latin; Latin-ASCII; [^A-Za-z0-9_] remove; Lower()', $originalFilename);
            $newFilename = $safeFilename . '-' . uniqid() . '.' . $imageFile->guessExtension();

            // Move the file to the directory where brochures are stored
            try {
                $imageFile->move(
                    $this->parameterBag->get('project_images_path'),
                    $newFilename
                );
            } catch (FileException $e) {
                // ... handle exception if something happens during file upload
            }
            $photoField->getData()->setUrl($newFilename);
            return $photoField->getData();
        }
        return null;
    }

}