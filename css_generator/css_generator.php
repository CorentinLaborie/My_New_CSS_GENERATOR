<?php

function CssGenerator()
{
  // READLINE //
    // TEXTE //
    $FirstReadline = "Bonjour ! Quel système préférez vous ?"."{-n/-normal pour cibler '"."./images'"."-r/-recursive pour cibler tout les dossiers dans '"."./images'} : ";
    $FirstReadlineError = "Je n'ai pas bien compris.. Veuillez répéter !\n";
    // LOGIC //
    $SoftwareType= readline($FirstReadline);

    if ($SoftwareType === "-n" || $SoftwareType === "-normal" || $SoftwareType === "-r" || $SoftwareType === "-recursive")
    {
      outputOptions($SoftwareType);
    }
    else
    {
      echo $FirstReadlineError;
      CssGenerator();
    }
}

function outputOptions($mode){
  // Readlines //
  $ImageNameAsk = readline("Renommer le sprite final ? Le nom par defaut sera 'My_New_Sprite'. (Y/N) : ");
  $StylesheetNameAsk = readline("Renommer le CSS final ? Le nom par defaut sera 'style.css'. (Y/N) : ");
  $PaddingAsk = readline("Souhaitez-vous un espace entre les images ? (Y/n) : ");
  $SizeAsk = readline("Souhaitez-vous redimensionner les images ? (Y/n)");
  $AxeXAsk = readline("Configurer le nombre d'image par ligne ? (Y/n)");

  $AskAnswer = array(
    "Image" => 0,
    "Stylesheet" => 0,
    "Padding" => 0,
    "Size" => 0,
    "AxeX" => 0,
  );
  // LOGIC ASK //
    if ($ImageNameAsk === "Y" || $ImageNameAsk === "y")
    {
      $AskAnswer["Image"] = 1;
    }
    elseif ($ImageNameAsk === "N" || $ImageNameAsk === "n")
    {
      $AskAnswer["Image"] = 0;
    }
    else{
      echo "Je n'ai pas bien compris.. Veuillez recommencer !";
    }
    if ($StylesheetNameAsk === "Y" || $StylesheetNameAsk === "y")
    {
      $AskAnswer["Stylesheet"] = 1;
    }
    elseif ($StylesheetNameAsk === "N" || $StylesheetNameAsk === "n")
    {
      $AskAnswer["Stylesheet"] = 0;
    }
    else{
      echo "Je n'ai pas bien compris.. Veuillez recommencer !";
    }
    if ($PaddingAsk === "Y" || $PaddingAsk === "y")
    {
      $AskAnswer["Padding"] = 1;
    }
    elseif ($PaddingAsk === "N" || $PaddingAsk === "n")
    {
      $AskAnswer["Padding"] = 0;
    }
    else{
      echo "Je n'ai pas bien compris.. Veuillez recommencer !";
    }
    if ($SizeAsk === "Y" || $SizeAsk === "y")
    {
      $AskAnswer["Size"] = 1;
    }
    elseif ($SizeAsk === "N" || $SizeAsk === "n")
    {
      $AskAnswer["Size"] = 0;
    }
    else{
      echo "Je n'ai pas bien compris.. Veuillez recommencer !";
    }
    if ($AxeXAsk === "Y" || $AxeXAsk === "y")
    {
      $AskAnswer["AxeX"] = 1;
    }
    elseif ($AxeXAsk === "N" || $AxeXAsk === "n")
    {
      $AskAnswer["AxeX"] = 0;
    }
    else{
      echo "Je n'ai pas bien compris.. Veuillez recommencer !";
    }
  // SETTING OPTIONS //

      if ($AskAnswer === array("Image" => 0, "Stylesheet" => 0, "Padding" => 0,"Size" => 0,"AxeX" => 0))
      {
        $options = (array("Image" => "My_New_Sprite" , "Stylesheet" => "style.css", "Padding" => null, "Size" => null, "AxeX" => null));
      }

      elseif ($AskAnswer === array("Image" => 1, "Stylesheet" => 0, "Padding" => 0,"Size" => 0,"AxeX" => 0))
      {
        $WhichImageName = readline("Quel sera le nom de ton sprite ? : ");
        $options = (array("Image" => $WhichImageName , "Stylesheet" => "style.css", "Padding" => null, "Size" => null, "AxeX" => null));
      }
      elseif ($AskAnswer === array("Image" => 0, "Stylesheet" => 1, "Padding" => 0,"Size" => 0,"AxeX" => 0))
      {
        $WhichStyleName = readline("Quel sera le nom de ton CSS ? : ");
        $options = (array("Image" => "My_New_Sprite" , "Stylesheet" => $WhichStyleName, "Padding" => null, "Size" => null, "AxeX" => null));
      }
      elseif ($AskAnswer === array("Image" => 0, "Stylesheet" => 0, "Padding" => 1,"Size" => 0,"AxeX" => 0))
      {
        $WhichPadding = readline("Quel padding entre chaque image ? (en PX) : ");
        $options = (array("Image" => "My_New_Sprite" , "Stylesheet" => "style.css", "Padding" => intval($WhichPadding), "Size" => null, "AxeX" => null));
      }
      elseif ($AskAnswer === array("Image" => 0, "Stylesheet" => 0, "Padding" => 0,"Size" => 1,"AxeX" => 0))
      {
        $WhichSize = readline("Quelle taille pour les images ? (Format PX/PX) : ");
        $options = (array("Image" => "My_New_Sprite" , "Stylesheet" => "style.css", "Padding" => null, "Size" => intval($WhichSize), "AxeX" => null));
      }
      elseif ($AskAnswer === array("Image" => 0, "Stylesheet" => 0, "Padding" => 0,"Size" => 0,"AxeX" => 1))
      {
        $WhichAxeX = readline("Combien d'images par lignes ? (Nombre) : ");
        $options = (array("Image" => "My_New_Sprite" , "Stylesheet" => "style.css", "Padding" => null, "Size" => null, "AxeX" => intval($WhichAxeX)));
      }

      elseif ($AskAnswer === array("Image" => 1, "Stylesheet" => 1, "Padding" => 0,"Size" => 0,"AxeX" => 0))
      {
        $WhichImageName = readline("Quel sera le nom de ton sprite ? : ");
        $WhichStyleName = readline("Quel sera le nom de ton CSS ? : ");
        $options = (array("Image" => $WhichImageName , "Stylesheet" => $WhichStyleName, "Padding" => null, "Size" => null, "AxeX" => null));
      }
      elseif ($AskAnswer === array("Image" => 1, "Stylesheet" => 0, "Padding" => 1,"Size" => 0,"AxeX" => 0))
      {
        $WhichImageName = readline("Quel sera le nom de ton sprite ? : ");
        $WhichPadding = readline("Quel padding entre chaque image ? (en PX) : ");
        $options = (array("Image" => $WhichImageName , "Stylesheet" => "style.css", "Padding" => intval($WhichPadding), "Size" => null, "AxeX" => null));
      }
      elseif ($AskAnswer === array("Image" => 1, "Stylesheet" => 0, "Padding" => 0,"Size" => 1,"AxeX" => 0))
      {
        $WhichImageName = readline("Quel sera le nom de ton sprite ? : ");
        $WhichSize = readline("Quelle taille pour les images ? (Format PX/PX) : ");
        $options = (array("Image" => $WhichImageName , "Stylesheet" => "style.css", "Padding" => null, "Size" => intval($WhichSize), "AxeX" => null));
      }
      elseif ($AskAnswer === array("Image" => 1, "Stylesheet" => 0, "Padding" => 0,"Size" => 0,"AxeX" => 1))
      {
        $WhichImageName = readline("Quel sera le nom de ton sprite ? : ");
        $WhichAxeX = readline("Combien d'images par lignes ? (Nombre) : ");
        $options = (array("Image" => $WhichImageName , "Stylesheet" => "style.css", "Padding" => null, "Size" => null, "AxeX" => intval($WhichAxeX)));
      }
      elseif ($AskAnswer === array("Image" => 0, "Stylesheet" => 1, "Padding" => 1,"Size" => 0,"AxeX" => 0))
      {
        $WhichStyleName = readline("Quel sera le nom de ton CSS ? : ");
        $WhichPadding = readline("Quel padding entre chaque image ? (en PX) : ");
        $options = (array("Image" => "My_New_Sprite" , "Stylesheet" => intval($WhichStyleName), "Padding" => intval($WhichPadding), "Size" => null, "AxeX" => null));
      }
      elseif ($AskAnswer === array("Image" => 0, "Stylesheet" => 1, "Padding" => 0,"Size" => 1,"AxeX" => 0))
      {
        $WhichStyleName = readline("Quel sera le nom de ton CSS ? : ");
        $WhichSize = readline("Quelle taille pour les images ? (Format PX/PX) : ");
        $options = (array("Image" => "My_New_Sprite" , "Stylesheet" => intval($WhichStyleName), "Padding" => null, "Size" => intval($WhichSize), "AxeX" => null));
      }
      elseif ($AskAnswer === array("Image" => 0, "Stylesheet" => 1, "Padding" => 0,"Size" => 0,"AxeX" => 1))
      {
        $WhichStyleName = readline("Quel sera le nom de ton CSS ? : ");
        $WhichAxeX = readline("Combien d'images par lignes ? (Nombre) : ");
        $options = (array("Image" => "My_New_Sprite" , "Stylesheet" => intval($WhichStyleName), "Padding" => null, "Size" => null, "AxeX" => intval($WhichAxeX)));
      }
      elseif ($AskAnswer === array("Image" => 0, "Stylesheet" => 0, "Padding" => 1,"Size" => 1,"AxeX" => 0))
      {
        $WhichPadding = readline("Quel padding entre chaque image ? (en PX) : ");
        $WhichSize = readline("Quelle taille pour les images ? (Format PX/PX) : ");
        $options = (array("Image" => "My_New_Sprite`" , "Stylesheet" => "style.css", "Padding" => intval($WhichPadding), "Size" => intval($WhichSize), "AxeX" => null));
      }
      elseif ($AskAnswer === array("Image" => 0, "Stylesheet" => 0, "Padding" => 1,"Size" => 0,"AxeX" => 1))
      {
        $WhichPadding = readline("Quel padding entre chaque image ? (en PX) : ");
        $WhichAxeX = readline("Combien d'images par lignes ? (Nombre) : ");
        $options = (array("Image" => "My_New_Sprite`" , "Stylesheet" => "style.css", "Padding" => intval($WhichPadding), "Size" => null, "AxeX" => intval($WhichAxeX)));
      }
      elseif ($AskAnswer === array("Image" => 0, "Stylesheet" => 0, "Padding" => 0,"Size" => 1,"AxeX" => 1))
      {
        $WhichSize = readline("Quelle taille pour les images ? (Format PX/PX) : ");
        $WhichAxeX = readline("Combien d'images par lignes ? (Nombre) : ");
        $options = (array("Image" => "My_New_Sprite`" , "Stylesheet" => "style.css", "Padding" => null, "Size" => intval($WhichSize), "AxeX" => intval($WhichAxeX)));
      }
      

      elseif ($AskAnswer === array("Image" => 1, "Stylesheet" => 1, "Padding" => 1,"Size" => 0,"AxeX" => 0))
      {
        $WhichImageName = readline("Quel sera le nom de ton sprite ? : ");
        $WhichStyleName = readline("Quel sera le nom de ton CSS ? : ");
        $WhichPadding = readline("Quel padding entre chaque image ? (en PX) : ");
        $options = (array("Image" => $WhichImageName , "Stylesheet" => $WhichStyleName, "Padding" => intval($WhichPadding), "Size" => null, "AxeX" => null));
      }
      elseif ($AskAnswer === array("Image" => 1, "Stylesheet" => 1, "Padding" => 0,"Size" => 1,"AxeX" => 0))
      {
        $WhichImageName = readline("Quel sera le nom de ton sprite ? : ");
        $WhichStyleName = readline("Quel sera le nom de ton CSS ? : ");
        $WhichSize = readline("Quelle taille pour les images ? (Format PX/PX) : ");
        $options = (array("Image" => $WhichImageName , "Stylesheet" => $WhichStyleName, "Padding" => null, "Size" => intval($WhichSize), "AxeX" => null));
      }
      elseif ($AskAnswer === array("Image" => 1, "Stylesheet" => 1, "Padding" => 0,"Size" => 0,"AxeX" => 1))
      {
        $WhichImageName = readline("Quel sera le nom de ton sprite ? : ");
        $WhichStyleName = readline("Quel sera le nom de ton CSS ? : ");
        $WhichAxeX = readline("Combien d'images par lignes ? (Nombre) : ");
        $options = (array("Image" => $WhichImageName , "Stylesheet" => $WhichStyleName, "Padding" => null, "Size" => null, "AxeX" => intval($WhichAxeX)));
      }
      elseif ($AskAnswer === array("Image" => 0, "Stylesheet" => 1, "Padding" => 1,"Size" => 1,"AxeX" => 0))
      {
        $WhichStyleName = readline("Quel sera le nom de ton CSS ? : ");
        $WhichPadding = readline("Quel padding entre chaque image ? (en PX) : ");
        $WhichSize = readline("Quelle taille pour les images ? (Format PX/PX) : ");
        $options = (array("Image" => "My_New_Sprite" , "Stylesheet" => $WhichStyleName, "Padding" => intval($WhichPadding), "Size" => intval($WhichSize), "AxeX" => null));
      }
      elseif ($AskAnswer === array("Image" => 0, "Stylesheet" => 1, "Padding" => 1,"Size" => 0,"AxeX" => 1))
      {
        $WhichStyleName = readline("Quel sera le nom de ton CSS ? : ");
        $WhichPadding = readline("Quel padding entre chaque image ? (en PX) : ");
        $WhichAxeX = readline("Combien d'images par lignes ? (Nombre) : ");
        $options = (array("Image" => "My_New_Sprite" , "Stylesheet" => $WhichStyleName, "Padding" => intval($WhichPadding), "Size" => null, "AxeX" => intval($WhichAxeX)));
      }
      elseif ($AskAnswer === array("Image" => 0, "Stylesheet" => 0, "Padding" => 1,"Size" => 1,"AxeX" => 1))
      {
        $WhichPadding = readline("Quel padding entre chaque image ? (en PX) : ");
        $WhichSize = readline("Quelle taille pour les images ? (Format PX/PX) : ");
        $WhichAxeX = readline("Combien d'images par lignes ? (Nombre) : ");
        $options = (array("Image" => "My_New_Sprite" , "Stylesheet" => "style.css", "Padding" => intval($WhichPadding), "Size" => intval($WhichSize), "AxeX" => intval($WhichAxeX)));
      }

      elseif ($AskAnswer === array("Image" => 0, "Stylesheet" => 1, "Padding" => 1,"Size" => 1,"AxeX" => 1))
      {
        $WhichImageName = readline("Quel sera le nom de ton sprite ? : ");
        $WhichStyleName = readline("Quel sera le nom de ton CSS ? : ");
        $WhichPadding = readline("Quel padding entre chaque image ? (en PX) : ");
        $WhichSize = readline("Quelle taille pour les images ? (Format PX/PX) : ");
        $WhichAxeX = readline("Combien d'images par lignes ? (Nombre) : ");
        $options = (array("Image" => "My_New_Sprite" , "Stylesheet" => $WhichStyleName, "Padding" => intval($WhichPadding), "Size" => intval($WhichSize), "AxeX" => intval($WhichAxeX)));
      }
      elseif ($AskAnswer === array("Image" => 1, "Stylesheet" => 0, "Padding" => 1,"Size" => 1,"AxeX" => 1))
      {
        $WhichImageName = readline("Quel sera le nom de ton sprite ? : ");
        $WhichPadding = readline("Quel padding entre chaque image ? (en PX) : ");
        $WhichSize = readline("Quelle taille pour les images ? (Format PX/PX) : ");
        $WhichAxeX = readline("Combien d'images par lignes ? (Nombre) : ");
        $options = (array("Image" => $WhichImageName , "Stylesheet" => "style.css", "Padding" => intval($WhichPadding), "Size" => intval($WhichSize), "AxeX" => intval($WhichAxeX)));
      }
      elseif ($AskAnswer === array("Image" => 1, "Stylesheet" => 1, "Padding" => 0,"Size" => 1,"AxeX" => 1))
      {
        $WhichImageName = readline("Quel sera le nom de ton sprite ? : ");
        $WhichStyleName = readline("Quel sera le nom de ton CSS ? : ");
        $WhichSize = readline("Quelle taille pour les images ? (Format PX/PX) : ");
        $WhichAxeX = readline("Combien d'images par lignes ? (Nombre) : ");
        $options = (array("Image" => $WhichImageName , "Stylesheet" => $WhichStyleName, "Padding" => null, "Size" => intval($WhichSize), "AxeX" => intval($WhichAxeX)));
      }
      elseif ($AskAnswer === array("Image" => 1, "Stylesheet" => 1, "Padding" => 1,"Size" => 0,"AxeX" => 1))
      {
        $WhichImageName = readline("Quel sera le nom de ton sprite ? : ");
        $WhichStyleName = readline("Quel sera le nom de ton CSS ? : ");
        $WhichPadding = readline("Quel padding entre chaque image ? (en PX) : ");
        $WhichAxeX = readline("Combien d'images par lignes ? (Nombre) : ");
        $options = (array("Image" => "My_New_Sprite" , "Stylesheet" => "style.css", "Padding" => intval($WhichPadding), "Size" => null, "AxeX" => intval($WhichAxeX)));
      }
      elseif ($AskAnswer === array("Image" => 1, "Stylesheet" => 1, "Padding" => 1,"Size" => 1,"AxeX" => 0))
      {
        $WhichImageName = readline("Quel sera le nom de ton sprite ? : ");
        $WhichStyleName = readline("Quel sera le nom de ton CSS ? : ");
        $WhichPadding = readline("Quel padding entre chaque image ? (en PX) : ");
        $WhichSize = readline("Quelle taille pour les images ? (Format PX/PX) : ");
        $options = (array("Image" => "My_New_Sprite" , "Stylesheet" => "style.css", "Padding" => intval($WhichPadding), "Size" => intval($WhichSize), "AxeX" => null));
      }

      elseif ($AskAnswer === array("Image" => 1, "Stylesheet" => 1, "Padding" => 1,"Size" => 1,"AxeX" => 1))
      {
        $WhichImageName = readline("Quel sera le nom de ton sprite ? : ");
        $WhichStyleName = readline("Quel sera le nom de ton CSS ? : ");
        $WhichPadding = readline("Quel padding entre chaque image ? (en PX) : ");
        $WhichSize = readline("Quelle taille pour les images ? (Format PX/PX) : ");
        $WhichAxeX = readline("Combien d'images par lignes ? (Nombre) : ");
        $options = (array("Image" => $WhichImageName , "Stylesheet" => $WhichStyleName, "Padding" => intval($WhichPadding), "Size" => intval($WhichSize), "AxeX" => intval($WhichAxeX)));
      }

      // Redirect with options //

      if ($mode === "-n" || $mode === "-normal")
      {
        firstFolderSprite($options);
      }
      elseif ($mode === "-r" || $mode === "-recursive")
      {
        recursiveSprite($options);
      }

};


  // FONCTIONS //

  function firstFolderSprite($options){
    $ImagesDir = __DIR__.'/images';

    if ($handle = opendir(__DIR__.'/images')) {
      while (false !== ($entry = readdir($handle))) {
        if ($entry != "." && $entry != "..") {
          $PathInDir = $ImagesDir."/".$entry;
          $MimeType = mime_content_type($PathInDir);
          echo $MimeType."\n\n";
          }
      }
      closedir($handle);
  }
  };

  function recursiveSprite($options){
    var_dump($options);
  };

CssGenerator();