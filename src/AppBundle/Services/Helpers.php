<?php

/* 
 * Servicio Helpers para 
 */

namespace AppBundle\Services;

class Helpers {
    
    //manager del documento
    public $manager;
    
    public function __construct($manager) {
        //manager de la petición
        $this->manager = $manager;
    }
    
    
    /*
     * Conversión a formato json
     * 
     * @param array $data
     * @return HTTP response Application/JSON
     */
    public function json($data) {
        //normalizamos la petición
        $normalizers = array(new \Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer());
        //encode JSON
        $encoders = array("json" => new \Symfony\Component\Serializer\Encoder\JsonEncoder());
        
        //serializamos
        $serializer = new \Symfony\Component\Serializer\Serializer($normalizers, $encoders);
        $json = $serializer->serialize($data, 'json');
        
        //enviamos HTTP response Application/JSON format y utf-8 encoding
        $response = new \Symfony\Component\HttpFoundation\Response;
        $response->setContent($json);
        //seteamos cabecera
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('charset', 'UTF-8');
        
        //devolvemos HTTP response
        return $response;
        
        
    }
    
    
}
