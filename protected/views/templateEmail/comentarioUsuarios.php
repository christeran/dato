<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>El dato</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <link href='http://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>
    </head>

    <table border="0" cellspacing="0" cellpadding="20">
        <tbody>
            <tr>
                <td bgcolor="#f7f7f7" width="100%" style="font-family:'lucida grande', tahoma, verdana, arial, sans-serif">
                    <table cellpadding="0" cellspacing="0" border="0" width="620">
                        <tbody>
                            <tr>
                                <td style="background:#e84d3b;color:white;font-weight:bold;font-family: 'Lobster', 'cursive', cursive;
                                        text-shadow: 1px 1px 1px #000;padding:4px 8px;vertical-align:middle;font-size:21px;font-weight:400;letter-spacing:-0.03em;text-align:left">
                                    <div style="margin-left: 10px;">
                                        <img style="width: 30px" src='<?php echo Yii::app()->getBaseUrl(true) ?>/themes/classic/img/eldato-bar-logo.png' />
                                    el dato</div>
                                </td>
                            </tr>
                            <tr>
                                <td style="background:#cd321d;color:white;font-weight:bold;font-family:'lucida grande', tahoma, verdana, arial, sans-serif;padding:4px 8px;vertical-align:middle;font-size:16px;letter-spacing:-0.03em;text-align:left">
                                    <br/>
                                </td>
                            </tr>
                            <tr>
                                <td style="background-color:#fff;border-bottom:1px solid #e34132;border-left:0px solid #ccc;border-right:0px solid #ccc;font-family:'lucida grande', tahoma, verdana, arial, sans-serif;padding:15px" valign="top">
                                    <table width="100%">
                                        <tbody>
                                            <tr>
                                                <td width="517" style="font-size:12px" valign="top" align="left">
                                                    <br/>
                                                    <div style="margin-bottom:15px"> 
                                                        <font color="#ff4629">
                                                            <b> <?php echo ucfirst($comentario->usuario->username)?></b>
                                                        </font> 
                                                         tambien comento en el dato :
                                                    </div>
                                                    <div style="margin-bottom:15px">
                                                        <div style="border-bottom:1px solid #ccc;line-height:5px">
                                                            &nbsp;
                                                        </div> 
                                                        <table cellpadding="0" style="">
                                                            <tbody>
                                                                <tr valign="top">
                                                                    <td style="padding:10px 3px 10px 0px">
                                                                        <a href="[object_link]" target="_blank">
                                                                            <?php if (isset($dato->foto)){?>
                                                                                <img style="border:0px none" alt="dato_image" src="<?php echo Yii::app()->getBaseUrl(true) ?>/dato/image/<?php echo $dato->id?>" width="80" height="80" align="absmiddle" border="2" />
                                                                            <?php }else {?> 
                                                                                <img style="border:0px none" alt="dato_image" src="<?php echo Yii::app()->getBaseUrl(true) ?>/themes/classic/img/eldato-main.png" width="80" height="80" align="absmiddle" border="2" />
                                                                            <?php } ?>
                                                                        </a>
                                                                    </td>
                                                                    <td  style="padding:10px 0px 10px 0px"><span style="font-size:11px;color:#3B5998">
                                                                            <a href="<?php echo Yii::app()->createAbsoluteUrl('dato/ver/'.$comentario->dato_id) ?>" 
                                                                                style="color:black;text-decoration:none;font-size:16px;font-weight:bold" target="_blank">
                                                                                <?php echo ucfirst($comentario->dato->titulo)?>
                                                                            </a>
                                                                        </span> 
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        <div style="border-bottom:1px solid #ccc;line-height:5px">
                                                            &nbsp;
                                                        </div> 
                                                        <font color="#330000">Comentario : </font>
                                                    </div>
                                                    <div style="margin-bottom:15px;margin-left: 15px;">
                                                        "<?php echo ucfirst($comentario->descripcion)?>"
                                                    </div>

                                                    <table cellspacing="0" cellpadding="0" style="padding-left: 10px">
                                                        <tbody>
                                                            <tr>
                                                                <td style="padding:5px 15px;background-color:#ff4629;">
                                                                    <a href="<?php echo Yii::app()->createAbsoluteUrl('dato/ver/'.$comentario->dato_id) ?>" style="color:#fff;font-size:13px;font-weight:bold;text-decoration:none" target="_blank">
                                                                        Ir a comentario
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>

                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div style="padding-top:15px"><table width="100%" cellspacing="0" cellpadding="0">
                                            <tbody>
                                                <tr>
                                                    <td style="background-color:#d9edf7;border:1px solid #31708f;color:#31708f;padding:10px;font-size:11px">
                                                        <div style="font-weight:bold;margin-bottom:2px">
                                                            Si tiene problemas con el enlace, copie y pegue la siguiente URL en su navegador:
                                                        </div>
                                                        <a href="<?php echo Yii::app()->createAbsoluteUrl('dato/ver/'.$comentario->dato_id) ?>" style="color:#3b5998;text-decoration:none" target="_blank">
                                                            <?php echo Yii::app()->createAbsoluteUrl('dato/ver/'.$comentario->dato_id) ?>
                                                        </a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <img src="[object_link]" alt="" style="border:0;height:1px;width:1px">
                                </td>
                            </tr>
                            <tr>
                                <td style="color:#999;padding:10px;font-size:11px;font-family:'lucida grande', tahoma, verdana, arial, sans-serif">
                                    Esta Email fue enviado por el dato
                                    <a href="[host]/slb/signup.php" style="color:#3b5998;text-decoration:none" target="_blank">
                                        
                                    </a>. 
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody> 
    </table> 
</html>