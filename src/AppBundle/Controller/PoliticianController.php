<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use BackendBundle\Document\Politician;
use AppBundle\Services\Helpers;
use Symfony\Component\JsonResponse;


/*
 * Controlador Politician
 * 
 * Incluye todos los métodos para realizar las acciones necesarias
 */


class PoliticianController extends Controller
{ 
    /**
     * Lista todos los elemetos de la coleccion Politicians
     * 
     * Utiliza DoctrineMongoDBBundle para trabajar con la bbdd
     * Utiliza KnpPaginatorBundle para la paginación de los resultados
     * Utiliza servicio Helpers para funciones auxiliares
     * 
     * @param Request request petición
     * @return HTTP response Application/JSON
     */
    public function indexAction(Request $request) {
        
        //Servicio Helper que contendrá algunas funciones auxiliares a utilizar
        $helpers = $this->get(Helpers::class);
        
        //Recuperamos el objeto gestor de documentos, usando DoctrineMongoDBBundle
        $repository = $this->get('doctrine_mongodb')
                ->getManager()
                ->getRepository('BackendBundle:Politician');
        //Recuperamos todos los políticos
        $query = $repository->findAll();
 
        //Paginamos haciendo uso del bundle KnpPaginatorBundle
        $paginator = $this->get('knp_paginator');
        //Recuperamos el número de página actual de la petición, default 1
        $page = $request->query->getInt('page', 1);
        //Número de resultados por página
        $items_per_page = 50;
        //Paginamos los resultados
        $pagination= $paginator->paginate($query, $page, $items_per_page);
        //Total de páginas
        $total_items_counts = $pagination->getTotalItemCount();
        
        //En el cado de éxito enviaremos un mensaje de éxito y los datos necesarios
        $data = array(
                'status' => 'success',
                'code' => 200,
                'total_items_count' => $total_items_counts,
                'page_actual' => $page,
                'items_per_page' => $items_per_page,
                'total_pages' => ceil($total_items_counts/$items_per_page),
                'politicians' => $pagination
        );
        
        //Convertimos a json el array de respuesta       
        return $helpers->json($data);
        
    }
    
    
    /**
     * Consulta de un político en funcion del valor de su id
     * 
     * Utiliza DoctrineMongoDBBundle para trabajar con la bbdd
     * Utiliza servicio Helpers para funciones auxiliares
     *
     * @param Request $request petición
     * @param id $id clave principal
     * @return HTTP response Application/JSON
     */
    public function detailAction(Request $request, $id = null) {
        
        //Servicio Helper que contendrá algunas funciones auxiliares a utilizar
        $helpers = $this->get(Helpers::class);
       
        //Recuperamos el objeto gestor de documentos, usando DoctrineMongoDBBundle
        $repository = $this->get('doctrine_mongodb')
                ->getManager()
                ->getRepository('BackendBundle:Politician');
        //Consulta por la clave primaria, pasada como arguento
        $politician = $repository->find($id);
        //Comprobamos si la consulta da resultado y si este es un objeto
        if ($politician && is_object($politician)) {
            //Si es así devolvemos mensaje de éxito y resultado
            $data = array(
                'status' => 'success',
                'code' => 200,
                'politician' => $politician
            );
        }
        else {
            //En caso contrario enviaremos mensaje de error
            $data = array(
                'status' => 'error',
                'code' => 404,
                'msg' => 'Politician not found'
            );
        }
        
        //Convertimos a json el array de respuesta    
        return $helpers->json($data);
    }
    
    
    /**
     * Modificar un político segun su id
     * 
     * Utiliza DoctrineMongoDBBundle para trabajar con la bbdd
     * Utiliza servicio Helpers para funciones auxiliares
     *
     * @param Request $request petición
     * @param id $id clave principal
     * @return HTTP response Application/JSON
     */
    public function updateAction(Request $request, $id = null) {
        
        //Servicio Helper que contendrá algunas funciones auxiliares a utilizar
        $helpers = $this->get(Helpers::class);
        //Recuperamos el objeto gestor de documentos, usando DoctrineMongoDBBundle
        $dm = $this->get('doctrine_mongodb')->getManager();
        $repository = $dm->getRepository('BackendBundle:Politician');
        //Consulta por la clave primaria, pasada como arguento
        $politician = $repository->find($id);
        
        //Comprobamos si la consulta da resultado y si este es un objeto
        if ($politician && is_object($politician)) {
            //Recibir datos que nos llegan por put del formulario
            $json = $request->get('json');
           
            //Pasar a php array
            $params = json_decode($json, JSON_UNESCAPED_UNICODE); 

            //Comprobamos que la petición no está vacía
            if ($json != null) {
                //Obtenemos los parámetros de las llamadas
                $titular = (isset($params['tITULAR'])) ? $params['tITULAR'] : null;            

                //Si se ha seleccionado un partido del desplegable asignar ese partido a partido_político
                $partido_para_filtro = (isset($params['pARTIDO_PARA_FILTRO'])) ? $params['pARTIDO_PARA_FILTRO'] : null;
                $partido = (isset($params['pARTIDO']) && @$params['pARTIDO']) ? $params['pARTIDO'] : $params['pARTIDO_PARA_FILTRO'];

                $genero = (isset($params['gENERO'])) ? $params['gENERO'] : null;

                //Si se ha seleccionado un cargo del desplegable asignar ese cargo a cargo
                $cargo_para_filtro = (isset($params['cARGO_PARA_FILTRO'])) ? $params['cARGO_PARA_FILTRO'] : null;
                $cargo = (isset($params['cARGO']) && @$params['cARGO']) ? $params['cARGO'] : $params['cARGO_PARA_FILTRO'];

                $institucion = (isset($params['iNSTITUCION'])) ? $params['iNSTITUCION'] : null;
                $cca = (isset($params['cCAA'])) ? $params['cCAA'] : null;
                $sueldobase_sueldo = (isset($params['sUELDOBASE_SUELDO'])) ? $params['sUELDOBASE_SUELDO'] : null;
                $complementos_sueldo = (isset($params['cOMPLEMENTOS_SUELDO'])) ? $params['cOMPLEMENTOS_SUELDO'] : null;
                $pagasextra_sueldo = (isset($params['pAGASEXTRA_SUELDO'])) ? $params['pAGASEXTRA_SUELDO'] : null;
                $otrasdietaseindemnizaciones_sueldo = (isset($params['oTRASDIETASEINDEMNIZACIONES_SUELDO'])) ? $params['oTRASDIETASEINDEMNIZACIONES_SUELDO'] : null;
                $trienios_sueldo = (isset($params['tRIENIOS_SUELDO'])) ? $params['tRIENIOS_SUELDO'] : null;
                $retribucionmensual = (isset($params['rETRIBUCIONMENSUAL'])) ? $params['rETRIBUCIONMENSUAL'] :  null;
                $retribucionanual = (isset($params['rETRIBUCIONANUAL'])) ? $params['rETRIBUCIONANUAL'] : null;
                $observaciones = (isset($params['oBSERVACIONES'])) ? $params['oBSERVACIONES'] : null;


                //Asignamos parametros al objeto si esta seleccionado en la actualización
                if($titular)				
                        $politician->setTITULAR($titular);
                if($partido)		
                        $politician->setPARTIDO($partido);
                if($partido_para_filtro)		
                        $politician->setPARTIDOPARAFILTRO($partido_para_filtro);
                if($genero)		
                        $politician->setGENERO($genero);
                if($cargo_para_filtro)		
                        $politician->setCARGOPARAFILTRO($cargo_para_filtro);
                if($cargo)		
                        $politician->setCARGO($cargo);
                if($institucion)		
                        $politician->setINSTITUCION($institucion);
                if($cca)		
                        $politician->setCCAA($cca);
                if($sueldobase_sueldo)		
                        $politician->setSUELDOBASESUELDO($sueldobase_sueldo);
                if($complementos_sueldo)		
                        $politician->setCOMPLEMENTOSSUELDO($complementos_sueldo);
                if($pagasextra_sueldo)		
                        $politician->setPAGASEXTRASUELDO($pagasextra_sueldo);
                if($otrasdietaseindemnizaciones_sueldo)		
                        $politician->setOTRASDIETASEINDEMNIZACIONESSUELDO($otrasdietaseindemnizaciones_sueldo);
                if($trienios_sueldo)		
                        $politician->setTRIENIOSSUELDO($trienios_sueldo);
                if($retribucionmensual)		
                        $politician->setRETRIBUCIONMENSUAL($retribucionmensual);
                if($retribucionanual)		
                        $politician->setRETRIBUCIONANUAL($retribucionanual);
                if($observaciones)		
                        $politician->setOBSERVACIONES($observaciones);

                //Flush para hacer la actualizacion
                $dm->flush();

                //Devolvemos datos en caso de éxito
                $data = array(
                        'status' => 'success',
                        'code' => 200,
                        'msg' => 'Politician updated',
                        'politician' => $politician
                );
            }
            else {
                //En caso contrario enviaremos mensaje de error
                $data = array(
                        'status' => 'error',
                        'code' => 400,
                        'msg' => 'Politician not updated, params failed'
                );
            }
        }
        else {
            //En caso contrario enviaremos mensaje de error
            $data = array(
                'status' => 'error',
                'code' => 404,
                'msg' => 'Politician not found'
            );
        }
		
        //Convertimos a json el array de respuesta   
        return $helpers->json($data);
		
    }
    
    
    /**
     * Crear un nuevo político
     *
     * Utiliza DoctrineMongoDBBundle para trabajar con la bbdd
     * Utiliza servicio Helpers para funciones auxiliares
     *
     * @param Request $request petición
     * @return HTTP reponse
     */
    public function createAction(Request $request) {
        
        //Servicio Helper que contendrá algunas funciones auxiliares a utilizar
        $helpers = $this->get(Helpers::class);
        //Recibir datos que nos llegan por post
        $json = $request->get('json');
        //Pasar a php array
        $params = json_decode($json, JSON_UNESCAPED_UNICODE); 
        
        //Comprobamos que la petición no está vacía
        if ($json != null) {
             //Obtenemos los parámetros de las llamadas
            $titular = (isset($params['tITULAR'])) ? $params['tITULAR'] : null;            

            //Si se ha seleccionado un partido del desplegable asignar ese partido a partido_político
            $partido_para_filtro = (isset($params['pARTIDO_PARA_FILTRO'])) ? $params['pARTIDO_PARA_FILTRO'] : null;
            $partido = (isset($params['pARTIDO']) && @$params['pARTIDO']) ? $params['pARTIDO'] : $params['pARTIDO_PARA_FILTRO'];

            $genero = (isset($params['gENERO'])) ? $params['gENERO'] : null;

            //Si se ha seleccionado un cargo del desplegable asignar ese cargo a cargo
            $cargo_para_filtro = (isset($params['cARGO_PARA_FILTRO'])) ? $params['cARGO_PARA_FILTRO'] : null;
            $cargo = (isset($params['cARGO']) && @$params['cARGO']) ? $params['cARGO'] : $params['cARGO_PARA_FILTRO'];

            $institucion = (isset($params['iNSTITUCION'])) ? $params['iNSTITUCION'] : null;
            $cca = (isset($params['cCAA'])) ? $params['cCAA'] : null;
            $sueldobase_sueldo = (isset($params['sUELDOBASE_SUELDO'])) ? $params['sUELDOBASE_SUELDO'] : null;
            $complementos_sueldo = (isset($params['cOMPLEMENTOS_SUELDO'])) ? $params['cOMPLEMENTOS_SUELDO'] : null;
            $pagasextra_sueldo = (isset($params['pAGASEXTRA_SUELDO'])) ? $params['pAGASEXTRA_SUELDO'] : null;
            $otrasdietaseindemnizaciones_sueldo = (isset($params['oTRASDIETASEINDEMNIZACIONES_SUELDO'])) ? $params['oTRASDIETASEINDEMNIZACIONES_SUELDO'] : null;
            $trienios_sueldo = (isset($params['tRIENIOS_SUELDO'])) ? $params['tRIENIOS_SUELDO'] : null;
            $retribucionmensual = (isset($params['rETRIBUCIONMENSUAL'])) ? $params['rETRIBUCIONMENSUAL'] :  null;
            $retribucionanual = (isset($params['rETRIBUCIONANUAL'])) ? $params['rETRIBUCIONANUAL'] : null;
            $observaciones = (isset($params['oBSERVACIONES'])) ? $params['oBSERVACIONES'] : null;
            
            //Asignamos parametros al objeto            
            $politician = new Politician();
            $politician->setTITULAR($titular);
            $politician->setPARTIDO($partido);
            $politician->setPARTIDOPARAFILTRO($partido_para_filtro);
            $politician->setGENERO($genero);
            $politician->setCARGOPARAFILTRO($cargo_para_filtro);
            $politician->setCARGO($cargo);
            $politician->setINSTITUCION($institucion);
            $politician->setCCAA($cca);
            $politician->setSUELDOBASESUELDO($sueldobase_sueldo);
            $politician->setCOMPLEMENTOSSUELDO($complementos_sueldo);
            $politician->setPAGASEXTRASUELDO($pagasextra_sueldo);
            $politician->setOTRASDIETASEINDEMNIZACIONESSUELDO($otrasdietaseindemnizaciones_sueldo);
            $politician->setTRIENIOSSUELDO($trienios_sueldo);
            $politician->setRETRIBUCIONMENSUAL($retribucionmensual);
            $politician->setRETRIBUCIONANUAL($retribucionanual);
            $politician->setOBSERVACIONES($observaciones);
                  
            
            //Cargamos el manager
            $dm = $this->get('doctrine_mongodb')->getManager();
            //Proceso de persistir
            $dm->persist($politician);
            //Flush
            $dm->flush();
            
            //En caso de éxito devolvemos la información y el mensaje de éxito
            $data = array(
                'status' => 'success',
                'code' => 200,
                'p' => $request,
                'msg' => 'Politician created',
                'politician' => $politician
            );
        }
        //En caso de error enviamos un mensaje erroneo
        else {
            $data = array(
                'status' => 'error',
                'code' => 400,
                'msg' => 'Politician not created, params failed'
            );
        }
        
        //Convertimos a json el array de respuesta   
        return $helpers->json($data);
    }
    
    
    
}