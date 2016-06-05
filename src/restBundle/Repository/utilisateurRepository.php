<?php

namespace restBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * utilisateurRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class utilisateurRepository extends EntityRepository
{
    function login($login,$pwd,$controller){
        if(empty($_COOKIE['authentification'])){
            if(connexion_ok($login,$pwd) == TRUE) { //fonction fictive....
                $_SESSION['logged'] = 1;
                session_regenerate_id();
                $jeton = md5(uniqid(rand(), TRUE)); //création d'un jeton
                setToken($jeton);
                $em = $controller->getDoctrine()->getManager();
                $em->flush();
                $user = encrypte($login); //On hash le nom d'utilisateur
                $vie = time() + 60; //durée de vie (ici, 7 jours)
                setcookie('authentification', "$jeton", $vie); //on crée le cookie
                return TRUE;
            }else{
                return FALSE;
            }
        }else{
            $jeton = $_COOKIE['authentification'];
            if(password_verify($login)){
                if($jeton == getToken()){
                    $_SESSION['logged'] = 1;
                    session_regenerate_id();
                    return TRUE;
                }
            }else{
                return FALSE;
            }
        }
    }

    function logout(){
        $_SESSION['logged'] = 0;
    }


    function encrypte($string){
        $options = ['cost' => 10];
        $stringEncode = password_hash($string, PASSWORD_BCRYPT,$options);
        return $stringEncode;
    }

    function connexion_ok(){
        if (getAction() != ""){
            return TRUE;
        }else{
            return FALSE;
        }
    }
}
