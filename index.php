<?php
  include_once 'Message.php';
  //include_once "Etudiant.php";
 /* $E=new Etudiant();
  $E->nom="ALAMI";
  $E->prenom="Amine";
  $E->email="amine@gmail.com";
 $E->save();*/
  $M=new Message();
$M->id=2;
  $M->adresse_exp="ensat@test.ma";
  $M->sujet="TP";
  $M->contenu="TP de java";
  $M->date_envoi="10/01/2023";
  $M->etat=0;
  //$M->save();
Message::find(50);
?>