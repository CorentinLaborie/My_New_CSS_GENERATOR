<?php

function CssGenerator()
{
  // READLINE //
    // TEXTE //
    $FirstReadline = "Bonjour ! Quel système préférez vous ?"."{ -n/-normal } pour cibler '"."./images'".", { -r/-recursive } pour cibler tout les dossiers dans '"."./images'} : ";
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

  $AskAnswer = array(
    "Image" => 0,
    "Stylesheet" => 0,
    "Padding" => 0,
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
      return;
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
      return;

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
      return;

    }

    // SETTING OPTIONS //
    if ($AskAnswer === array("Image" => 0, "Stylesheet" => 0, "Padding" => 0))
    {
      $options = (array("Image" => "My_New_Sprite" , "Stylesheet" => "style", "Padding" => null));
    }

    elseif ($AskAnswer === array("Image" => 1, "Stylesheet" => 0, "Padding" => 0))
    {
      $WhichImageName = readline("Quel sera le nom de ton sprite ? : ");
      $options = (array("Image" => $WhichImageName , "Stylesheet" => "style", "Padding" => null));
    }
    elseif ($AskAnswer === array("Image" => 0, "Stylesheet" => 1, "Padding" => 0))
    {
      $WhichStyleName = readline("Quel sera le nom de ton CSS ? : ");
      $options = (array("Image" => "My_New_Sprite" , "Stylesheet" => $WhichStyleName, "Padding" => null));
    }
    elseif ($AskAnswer === array("Image" => 0, "Stylesheet" => 0, "Padding" => 1))
    {
      $WhichPadding = readline("Quel padding entre chaque image ? (en PX) : ");
      $options = (array("Image" => "My_New_Sprite" , "Stylesheet" => "style", "Padding" => intval($WhichPadding)));
    }
    

    elseif ($AskAnswer === array("Image" => 1, "Stylesheet" => 1, "Padding" => 0))
    {
      $WhichImageName = readline("Quel sera le nom de ton sprite ? : ");
      $WhichStyleName = readline("Quel sera le nom de ton CSS ? : ");
      $options = (array("Image" => $WhichImageName , "Stylesheet" => $WhichStyleName, "Padding" => null));
    }
    elseif ($AskAnswer === array("Image" => 1, "Stylesheet" => 0, "Padding" => 1))
    {
      $WhichImageName = readline("Quel sera le nom de ton sprite ? : ");
      $WhichPadding = readline("Quel padding entre chaque image ? (en PX) : ");
      $options = (array("Image" => $WhichImageName , "Stylesheet" => "style", "Padding" => intval($WhichPadding)));
    }
    elseif ($AskAnswer === array("Image" => 0, "Stylesheet" => 1, "Padding" => 1))
    {
      $WhichStyleName = readline("Quel sera le nom de ton CSS ? : ");
      $WhichPadding = readline("Quel padding entre chaque image ? (en PX) : ");
      $options = (array("Image" => "My_New_Sprite" , "Stylesheet" => intval($WhichStyleName), "Padding" => intval($WhichPadding)));
    }
      
    elseif ($AskAnswer === array("Image" => 1, "Stylesheet" => 1, "Padding" => 1))
    {
      $WhichImageName = readline("Quel sera le nom de ton sprite ? : ");
      $WhichStyleName = readline("Quel sera le nom de ton CSS ? : ");
      $WhichPadding = readline("Quel padding entre chaque image ? (en PX) : ");
      $options = (array("Image" => $WhichImageName , "Stylesheet" => $WhichStyleName, "Padding" => intval($WhichPadding)));
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
    
    // RECUPERER DATAS FICHIERS ET TRIER //
    $images = [];
    $ImagesNames = [];
    $ImagesDir = __DIR__.'/images';
    if ($handle = opendir(__DIR__.'/images'))
    {
      while (false !== ($entry = readdir($handle)))
      {
        if ($entry != "." && $entry != "..") 
        {
          // GET PATH //
          $PathInDir = $ImagesDir."/".$entry;
          $MimeType = mime_content_type($PathInDir);
          $IsImage = strstr($MimeType, "image");
          $IsIsset = isset($IsImage);
          if ($MimeType != "directory" && $IsImage != false)
          {
            // GET NAME //
            $FileName = basename($PathInDir,".png");
            // PUSH //
            array_push($images, $PathInDir);
            array_push($ImagesNames, $FileName);
          }
          else{
            continue;
          }
        }
      }
      closedir($handle);
    }

    // CREER SPRITE ET INSERER DEDANS 1-0-0 //
    if ($options["Image"] != "My_New_Sprite" && $options["Stylesheet"] == "style" && $options["Padding"] == null)
    {
      $BaseWidth = 0;
      $BaseHeight = 0;
      for ($i = 0; $i < count($images); $i++)
      {
        $ImgDatas = getimagesize(($images[$i]));
        $ImageWidth = $ImgDatas[0];
        $ImageHeight = $ImgDatas[1];
        $BaseWidth = $BaseWidth + $ImageWidth;
        if ($BaseHeight < $ImageHeight)
        {
          $BaseHeight = $ImageHeight;
        }
      }
      $ImgRessource = imagecreatetruecolor($BaseWidth ,$BaseHeight);
      $black = imagecolorallocate($ImgRessource, 0, 0 ,0); 
      imagecolortransparent($ImgRessource, $black);


      $BaseWidth = 0;
      $BaseHeight = 0;
      for ($i = 0; $i < count($images); $i++)
      {
        $ImgDatas = getimagesize(($images[$i]));
        $ImageWidth = $ImgDatas[0];
        $ImageHeight = $ImgDatas[1];
        $imagecreatefrompng = imagecreatefrompng($images[$i]);
        imagecopymerge($ImgRessource, $imagecreatefrompng, $BaseWidth, 0, 0, 0, $ImageWidth, $ImageHeight, 100);
        $BaseWidth = $BaseWidth + $ImageWidth;
      }
      $FINALPNG = imagepng($ImgRessource , "./sprites/".$options["Image"].".png");

      // CREER FICHIER CSS //
      $BaseWidth = 0;
      $BaseHeight = 0;
      $FinalPngICTP = imagecreatefrompng("./sprites/".$options["Image"].".png");
      $FinalPngDatas = getimagesize("./sprites/".$options["Image"].".png");
      $FirstScriptCSS = ".sprite{"."\n"."    " . "width:$FinalPngDatas[0]px;"."\n"."height:$FinalPngDatas[1]px;\n}\n\n";
      file_put_contents("./stylesheets/".$options["Stylesheet"].".css", $FirstScriptCSS);
      for ($i = 0; $i < count($ImagesNames); $i++)
      {
        $ImgDatas = getimagesize(($images[$i]));
        $ImgName = $ImagesNames[$i];
        $ImageWidth = $ImgDatas[0];
        $ImageHeight = $ImgDatas[1];
        if ($i === 0)
        {
          $BaseWidth = 0 - -($BaseWidth) + -($ImageWidth);
          $Css = ".sprite-" .$ImgName. "{" . "\n" . "    " . "width:$ImageWidth"."px;\n"."height:$ImageHeight"."px;\n background-position:$BaseWidth"."px;\n}\n\n";
          file_put_contents("./stylesheets/".$options["Stylesheet"].".css", $Css , FILE_APPEND);
        }
        elseif ($i > 0)
        {
          $BaseWidth = 0 + -($BaseWidth) + -($ImageWidth);
          $Css = ".sprite-" .$ImgName. "{" . "\n" . "    " . "width:$ImageWidth"."px;\n"."height:$ImageHeight"."px;\n background-position:$BaseWidth"."px;\n}\n\n";
          file_put_contents("./stylesheets/".$options["Stylesheet"].".css", $Css , FILE_APPEND);
        }
      }
  };

  // CREER SPRITE ET INSERER DEDANS 0-1-0 //
  if ($options["Image"] == "My_New_Sprite" && $options["Stylesheet"] != "style" && $options["Padding"] == null)
  {
    $BaseWidth = 0;
    $BaseHeight = 0;
    for ($i = 0; $i < count($images); $i++)
    {
      $ImgDatas = getimagesize(($images[$i]));
      $ImageWidth = $ImgDatas[0];
      $ImageHeight = $ImgDatas[1];
      $BaseWidth = $BaseWidth + $ImageWidth;
      if ($BaseHeight < $ImageHeight)
      {
        $BaseHeight = $ImageHeight;
      }
    }
    $ImgRessource = imagecreatetruecolor($BaseWidth ,$BaseHeight);
    $black = imagecolorallocate($ImgRessource, 0, 0 ,0); 
    imagecolortransparent($ImgRessource, $black);


    $BaseWidth = 0;
    $BaseHeight = 0;
    for ($i = 0; $i < count($images); $i++)
    {
      $ImgDatas = getimagesize(($images[$i]));
      $ImageWidth = $ImgDatas[0];
      $ImageHeight = $ImgDatas[1];
      $imagecreatefrompng = imagecreatefrompng($images[$i]);
      imagecopymerge($ImgRessource, $imagecreatefrompng, $BaseWidth, 0, 0, 0, $ImageWidth, $ImageHeight, 100);
      $BaseWidth = $BaseWidth + $ImageWidth;
    }
    $FINALPNG = imagepng($ImgRessource , "./sprites/".$options["Image"].".png");

    // CREER FICHIER CSS //
    $BaseWidth = 0;
    $BaseHeight = 0;
    $FinalPngICTP = imagecreatefrompng("./sprites/".$options["Image"].".png");
    $FinalPngDatas = getimagesize("./sprites/".$options["Image"].".png");
    $FirstScriptCSS = ".sprite{"."\n"."    " . "width:$FinalPngDatas[0]px;"."\n"."height:$FinalPngDatas[1]px;\n}\n\n";
    file_put_contents("./stylesheets/".$options["Stylesheet"].".css", $FirstScriptCSS);
    for ($i = 0; $i < count($ImagesNames); $i++)
    {
      $ImgDatas = getimagesize(($images[$i]));
      $ImgName = $ImagesNames[$i];
      $ImageWidth = $ImgDatas[0];
      $ImageHeight = $ImgDatas[1];
      if ($i === 0)
      {
        $BaseWidth = 0 - -($BaseWidth) + -($ImageWidth);
        $Css = ".sprite-" .$ImgName. "{" . "\n" . "    " . "width:$ImageWidth"."px;\n"."height:$ImageHeight"."px;\n background-position:$BaseWidth"."px;\n}\n\n";
        file_put_contents("./stylesheets/".$options["Stylesheet"].".css", $Css , FILE_APPEND);
      }
      elseif ($i > 0)
      {
        $BaseWidth = 0 + -($BaseWidth) + -($ImageWidth);
        $Css = ".sprite-" .$ImgName. "{" . "\n" . "    " . "width:$ImageWidth"."px;\n"."height:$ImageHeight"."px;\n background-position:$BaseWidth"."px;\n}\n\n";
        file_put_contents("./stylesheets/".$options["Stylesheet"].".css", $Css , FILE_APPEND);
      }
    }
};

// CREER SPRITE ET INSERER DEDANS 0-0-1 //
if ($options["Image"] == "My_New_Sprite" && $options["Stylesheet"] == "style" && $options["Padding"] != null)
{
  $BaseWidth = 0;
  $BaseHeight = 0;
  for ($i = 0; $i < count($images); $i++)
  {
    $ImgDatas = getimagesize(($images[$i]));
    $ImageWidth = $ImgDatas[0];
    $ImageHeight = $ImgDatas[1];
    $BaseWidth = $BaseWidth + $options["Padding"] + $ImageWidth;
    if ($BaseHeight < $ImageHeight)
    {
      $BaseHeight = $ImageHeight;
    }
  }
  $ImgRessource = imagecreatetruecolor($BaseWidth ,$BaseHeight);
  $black = imagecolorallocate($ImgRessource, 0, 0 ,0); 
  imagecolortransparent($ImgRessource, $black);


  $BaseWidth = 0;
  $BaseHeight = 0;
  for ($i = 0; $i < count($images); $i++)
  {
    $ImgDatas = getimagesize(($images[$i]));
    $ImageWidth = $ImgDatas[0];
    $ImageHeight = $ImgDatas[1];
    $imagecreatefrompng = imagecreatefrompng($images[$i]);
    imagecopymerge($ImgRessource, $imagecreatefrompng, $BaseWidth, 0, 0, 0, $ImageWidth, $ImageHeight, 100);
    $BaseWidth = $BaseWidth + $options["Padding"] + $ImageWidth;
  }
  $FINALPNG = imagepng($ImgRessource , "./sprites/".$options["Image"].".png");

  // CREER FICHIER CSS //
  $BaseWidth = 0;
  $BaseHeight = 0;
  $FinalPngICTP = imagecreatefrompng("./sprites/".$options["Image"].".png");
  $FinalPngDatas = getimagesize("./sprites/".$options["Image"].".png");
  $FirstScriptCSS = ".sprite{"."\n"."    " . "width:$FinalPngDatas[0]px;"."\n"."height:$FinalPngDatas[1]px;\n}\n\n";
  file_put_contents("./stylesheets/".$options["Stylesheet"].".css", $FirstScriptCSS);
  for ($i = 0; $i < count($ImagesNames); $i++)
  {
    $ImgDatas = getimagesize(($images[$i]));
    $ImgName = $ImagesNames[$i];
    $ImageWidth = $ImgDatas[0];
    $ImageHeight = $ImgDatas[1];
    if ($i === 0)
    {
      $BaseWidth = 0 - -($BaseWidth) + -($ImageWidth);
      $Css = ".sprite-" .$ImgName. "{" . "\n" . "    " . "width:$ImageWidth"."px;\n"."height:$ImageHeight"."px;\n background-position:$BaseWidth"."px;\n}\n\n";
      file_put_contents("./stylesheets/".$options["Stylesheet"].".css", $Css , FILE_APPEND);
    }
    elseif ($i > 0)
    {
      $BaseWidth = 0 + -($options["Padding"]) - -($BaseWidth) + -($ImageWidth);
      $Css = ".sprite-" .$ImgName. "{" . "\n" . "    " . "width:$ImageWidth"."px;\n"."height:$ImageHeight"."px;\n background-position:$BaseWidth"."px;\n}\n\n";
      file_put_contents("./stylesheets/".$options["Stylesheet"].".css", $Css , FILE_APPEND);
    }
  }
};

    // CREER SPRITE ET INSERER DEDANS 1-1-0 //
    if ($options["Image"] != "My_New_Sprite" && $options["Stylesheet"] != "style" && $options["Padding"] == null)
    {
      $BaseWidth = 0;
      $BaseHeight = 0;
      for ($i = 0; $i < count($images); $i++)
      {
        $ImgDatas = getimagesize(($images[$i]));
        $ImageWidth = $ImgDatas[0];
        $ImageHeight = $ImgDatas[1];
        $BaseWidth = $BaseWidth + $ImageWidth;
        if ($BaseHeight < $ImageHeight)
        {
          $BaseHeight = $ImageHeight;
        }
      }
      $ImgRessource = imagecreatetruecolor($BaseWidth ,$BaseHeight);
      $black = imagecolorallocate($ImgRessource, 0, 0 ,0); 
      imagecolortransparent($ImgRessource, $black);


      $BaseWidth = 0;
      $BaseHeight = 0;
      for ($i = 0; $i < count($images); $i++)
      {
        $ImgDatas = getimagesize(($images[$i]));
        $ImageWidth = $ImgDatas[0];
        $ImageHeight = $ImgDatas[1];
        $imagecreatefrompng = imagecreatefrompng($images[$i]);
        imagecopymerge($ImgRessource, $imagecreatefrompng, $BaseWidth, 0, 0, 0, $ImageWidth, $ImageHeight, 100);
        $BaseWidth = $BaseWidth + $ImageWidth;
      }
      $FINALPNG = imagepng($ImgRessource , "./sprites/".$options["Image"].".png");

      // CREER FICHIER CSS //
      $BaseWidth = 0;
      $BaseHeight = 0;
      $FinalPngICTP = imagecreatefrompng("./sprites/".$options["Image"].".png");
      $FinalPngDatas = getimagesize("./sprites/".$options["Image"].".png");
      $FirstScriptCSS = ".sprite{"."\n"."    " . "width:$FinalPngDatas[0]px;"."\n"."height:$FinalPngDatas[1]px;\n}\n\n";
      file_put_contents("./stylesheets/".$options["Stylesheet"].".css", $FirstScriptCSS);
      for ($i = 0; $i < count($ImagesNames); $i++)
      {
        $ImgDatas = getimagesize(($images[$i]));
        $ImgName = $ImagesNames[$i];
        $ImageWidth = $ImgDatas[0];
        $ImageHeight = $ImgDatas[1];
        if ($i === 0)
        {
          $BaseWidth = 0 - -($BaseWidth) + -($ImageWidth);
          $Css = ".sprite-" .$ImgName. "{" . "\n" . "    " . "width:$ImageWidth"."px;\n"."height:$ImageHeight"."px;\n background-position:$BaseWidth"."px;\n}\n\n";
          file_put_contents("./stylesheets/".$options["Stylesheet"].".css", $Css , FILE_APPEND);
        }
        elseif ($i > 0)
        {
          $BaseWidth = 0 + -($BaseWidth) + -($ImageWidth);
          $Css = ".sprite-" .$ImgName. "{" . "\n" . "    " . "width:$ImageWidth"."px;\n"."height:$ImageHeight"."px;\n background-position:$BaseWidth"."px;\n}\n\n";
          file_put_contents("./stylesheets/".$options["Stylesheet"].".css", $Css , FILE_APPEND);
        }
      }
  };

    
    // CREER SPRITE ET INSERER DEDANS 0-1-1 //
    if ($options["Image"] == "My_New_Sprite" && $options["Stylesheet"] != "style" && $options["Padding"] != null)
    {
      $BaseWidth = 0;
      $BaseHeight = 0;
      for ($i = 0; $i < count($images); $i++)
      {
        $ImgDatas = getimagesize(($images[$i]));
        $ImageWidth = $ImgDatas[0];
        $ImageHeight = $ImgDatas[1];
        $BaseWidth = $BaseWidth + $options["Padding"] + $ImageWidth;
        if ($BaseHeight < $ImageHeight)
        {
          $BaseHeight = $ImageHeight;
        }
      }
      $ImgRessource = imagecreatetruecolor($BaseWidth ,$BaseHeight);
      $black = imagecolorallocate($ImgRessource, 0, 0 ,0); 
      imagecolortransparent($ImgRessource, $black);


      $BaseWidth = 0;
      $BaseHeight = 0;
      for ($i = 0; $i < count($images); $i++)
      {
        $ImgDatas = getimagesize(($images[$i]));
        $ImageWidth = $ImgDatas[0];
        $ImageHeight = $ImgDatas[1];
        $imagecreatefrompng = imagecreatefrompng($images[$i]);
        imagecopymerge($ImgRessource, $imagecreatefrompng, $BaseWidth, 0, 0, 0, $ImageWidth, $ImageHeight, 100);
        $BaseWidth = $BaseWidth + $options["Padding"] + $ImageWidth;
      }
      $FINALPNG = imagepng($ImgRessource , "./sprites/".$options["Image"].".png");

      // CREER FICHIER CSS //
      $BaseWidth = 0;
      $BaseHeight = 0;
      $FinalPngICTP = imagecreatefrompng("./sprites/".$options["Image"].".png");
      $FinalPngDatas = getimagesize("./sprites/".$options["Image"].".png");
      $FirstScriptCSS = ".sprite{"."\n"."    " . "width:$FinalPngDatas[0]px;"."\n"."height:$FinalPngDatas[1]px;\n}\n\n";
      file_put_contents("./stylesheets/".$options["Stylesheet"].".css", $FirstScriptCSS);
      for ($i = 0; $i < count($ImagesNames); $i++)
      {
        $ImgDatas = getimagesize(($images[$i]));
        $ImgName = $ImagesNames[$i];
        $ImageWidth = $ImgDatas[0];
        $ImageHeight = $ImgDatas[1];
        if ($i === 0)
        {
          $BaseWidth = 0 - -($BaseWidth) + -($ImageWidth);
          $Css = ".sprite-" .$ImgName. "{" . "\n" . "    " . "width:$ImageWidth"."px;\n"."height:$ImageHeight"."px;\n background-position:$BaseWidth"."px;\n}\n\n";
          file_put_contents("./stylesheets/".$options["Stylesheet"].".css", $Css , FILE_APPEND);
        }
        elseif ($i > 0)
        {
          $BaseWidth = 0 + -($options["Padding"]) - -($BaseWidth) + -($ImageWidth);
          $Css = ".sprite-" .$ImgName. "{" . "\n" . "    " . "width:$ImageWidth"."px;\n"."height:$ImageHeight"."px;\n background-position:$BaseWidth"."px;\n}\n\n";
          file_put_contents("./stylesheets/".$options["Stylesheet"].".css", $Css , FILE_APPEND);
        }
      }
  };

  // CREER SPRITE ET INSERER DEDANS 1-0-1 //
  if ($options["Image"] != "My_New_Sprite" && $options["Stylesheet"] == "style" && $options["Padding"] != null)
  {
    $BaseWidth = 0;
    $BaseHeight = 0;
    for ($i = 0; $i < count($images); $i++)
    {
      $ImgDatas = getimagesize(($images[$i]));
      $ImageWidth = $ImgDatas[0];
      $ImageHeight = $ImgDatas[1];
      $BaseWidth = $BaseWidth + $options["Padding"] + $ImageWidth;
      if ($BaseHeight < $ImageHeight)
      {
        $BaseHeight = $ImageHeight;
      }
    }
    $ImgRessource = imagecreatetruecolor($BaseWidth ,$BaseHeight);
    $black = imagecolorallocate($ImgRessource, 0, 0 ,0); 
    imagecolortransparent($ImgRessource, $black);


    $BaseWidth = 0;
    $BaseHeight = 0;
    for ($i = 0; $i < count($images); $i++)
    {
      $ImgDatas = getimagesize(($images[$i]));
      $ImageWidth = $ImgDatas[0];
      $ImageHeight = $ImgDatas[1];
      $imagecreatefrompng = imagecreatefrompng($images[$i]);
      imagecopymerge($ImgRessource, $imagecreatefrompng, $BaseWidth, 0, 0, 0, $ImageWidth, $ImageHeight, 100);
      $BaseWidth = $BaseWidth + $options["Padding"] + $ImageWidth;
    }
    $FINALPNG = imagepng($ImgRessource , "./sprites/".$options["Image"].".png");

    // CREER FICHIER CSS //
    $BaseWidth = 0;
    $BaseHeight = 0;
    $FinalPngICTP = imagecreatefrompng("./sprites/".$options["Image"].".png");
    $FinalPngDatas = getimagesize("./sprites/".$options["Image"].".png");
    $FirstScriptCSS = ".sprite{"."\n"."    " . "width:$FinalPngDatas[0]px;"."\n"."height:$FinalPngDatas[1]px;\n}\n\n";
    file_put_contents("./stylesheets/".$options["Stylesheet"].".css", $FirstScriptCSS);
    for ($i = 0; $i < count($ImagesNames); $i++)
    {
      $ImgDatas = getimagesize(($images[$i]));
      $ImgName = $ImagesNames[$i];
      $ImageWidth = $ImgDatas[0];
      $ImageHeight = $ImgDatas[1];
      if ($i === 0)
      {
        $BaseWidth = 0 - -($BaseWidth) + -($ImageWidth);
        $Css = ".sprite-" .$ImgName. "{" . "\n" . "    " . "width:$ImageWidth"."px;\n"."height:$ImageHeight"."px;\n background-position:$BaseWidth"."px;\n}\n\n";
        file_put_contents("./stylesheets/".$options["Stylesheet"].".css", $Css , FILE_APPEND);
      }
      elseif ($i > 0)
      {
        $BaseWidth = 0 + -($options["Padding"]) - -($BaseWidth) + -($ImageWidth);
        $Css = ".sprite-" .$ImgName. "{" . "\n" . "    " . "width:$ImageWidth"."px;\n"."height:$ImageHeight"."px;\n background-position:$BaseWidth"."px;\n}\n\n";
        file_put_contents("./stylesheets/".$options["Stylesheet"].".css", $Css , FILE_APPEND);
      }
    }
};

  // CREER SPRITE ET INSERER DEDANS 1-1-1 //
  if ($options["Image"] != "My_New_Sprite" && $options["Stylesheet"] != "style" && $options["Padding"] != null)
  {
    $BaseWidth = 0;
    $BaseHeight = 0;
    for ($i = 0; $i < count($images); $i++)
    {
      $ImgDatas = getimagesize(($images[$i]));
      $ImageWidth = $ImgDatas[0];
      $ImageHeight = $ImgDatas[1];
      $BaseWidth = $BaseWidth + $options["Padding"] + $ImageWidth;
      if ($BaseHeight < $ImageHeight)
      {
        $BaseHeight = $ImageHeight;
      }
    }
    $ImgRessource = imagecreatetruecolor($BaseWidth ,$BaseHeight);
    $black = imagecolorallocate($ImgRessource, 0, 0 ,0); 
    imagecolortransparent($ImgRessource, $black);


    $BaseWidth = 0;
    $BaseHeight = 0;
    for ($i = 0; $i < count($images); $i++)
    {
      $ImgDatas = getimagesize(($images[$i]));
      $ImageWidth = $ImgDatas[0];
      $ImageHeight = $ImgDatas[1];
      $imagecreatefrompng = imagecreatefrompng($images[$i]);
      imagecopymerge($ImgRessource, $imagecreatefrompng, $BaseWidth, 0, 0, 0, $ImageWidth, $ImageHeight, 100);
      $BaseWidth = $BaseWidth + $options["Padding"] + $ImageWidth;
    }
    $FINALPNG = imagepng($ImgRessource , "./sprites/".$options["Image"].".png");

    // CREER FICHIER CSS //
    $BaseWidth = 0;
    $BaseHeight = 0;
    $FinalPngICTP = imagecreatefrompng("./sprites/".$options["Image"].".png");
    $FinalPngDatas = getimagesize("./sprites/".$options["Image"].".png");
    $FirstScriptCSS = ".sprite{"."\n"."    " . "width:$FinalPngDatas[0]px;"."\n"."height:$FinalPngDatas[1]px;\n}\n\n";
    file_put_contents("./stylesheets/".$options["Stylesheet"].".css", $FirstScriptCSS);
    for ($i = 0; $i < count($ImagesNames); $i++)
    {
      $ImgDatas = getimagesize(($images[$i]));
      $ImgName = $ImagesNames[$i];
      $ImageWidth = $ImgDatas[0];
      $ImageHeight = $ImgDatas[1];
      if ($i === 0)
      {
        $BaseWidth = 0 - -($BaseWidth) + -($ImageWidth);
        $Css = ".sprite-" .$ImgName. "{" . "\n" . "    " . "width:$ImageWidth"."px;\n"."height:$ImageHeight"."px;\n background-position:$BaseWidth"."px;\n}\n\n";
        file_put_contents("./stylesheets/".$options["Stylesheet"].".css", $Css , FILE_APPEND);
      }
      elseif ($i > 0)
      {
        $BaseWidth = 0 + -($options["Padding"]) - -($BaseWidth) + -($ImageWidth);
        $Css = ".sprite-" .$ImgName. "{" . "\n" . "    " . "width:$ImageWidth"."px;\n"."height:$ImageHeight"."px;\n background-position:$BaseWidth"."px;\n}\n\n";
        file_put_contents("./stylesheets/".$options["Stylesheet"].".css", $Css , FILE_APPEND);
      }
    }

    echo "C'est bon ! Va voir les dossiers './sprites' et './stylesheets' !!";
  };

  function recursiveSprite($options){
    var_dump($options);
  };
}
CssGenerator();