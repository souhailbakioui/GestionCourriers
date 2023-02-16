<?php
  include_once 'Message.php';
  include_once 'Etudiant.php';
  //include_once "Etudiant.php";
  $E=new Etudiant();
  $E->nom="ALAMI";
  $E->prenom="Amine";
  $E->adress="amine@gmail.com";
  $E->tel="06663580";
  $E->email="amine@gmail.com";
  $E->age=18;
 $E->save();
  $M=new Message();
  
  $M->adresse_exp="ensat@test.ma";
  $M->sujet="TP 2";
  $M->contenu="TP Contune";
  $M->date_envoi="10/01/2023";
  $M->etat=0;
  $M->save();
//Message::All();
?>