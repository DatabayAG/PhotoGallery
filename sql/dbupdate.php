<#1>
<?php
    if (!$ilDB->tableExists('rep_robj_xpho_data')) {
    $fields = array(
        'id' => array(
            'type' => 'integer',
            'length' => 4,
            'notnull' => true
        ),
        'is_online' => array(
            'type' => 'integer',
            'length' => 1,
            'notnull' => false
        ),
    );

    $ilDB->createTable("rep_robj_xpho_data", $fields);
    $ilDB->addPrimaryKey("rep_robj_xpho_data", array("id"));
    }
?>

<#2>
<?php
require_once "./Customizing/global/plugins/Services/Repository/RepositoryObject/PhotoGallery/classes/Album/class.srObjAlbum.php";
srObjAlbum::installDB();
?>

<#3>
<?php
require_once "./Customizing/global/plugins/Services/Repository/RepositoryObject/PhotoGallery/classes/Picture/class.srObjPicture.php";
srObjPicture::installDB();
?>
<#4>
<?php
//Adding a new Permission rep_robj_xpho_download_images ("Download Images")
require_once("./Services/Migration/DBUpdate_3560/classes/class.ilDBUpdateNewObjectType.php");
$orgu_type_id = ilDBUpdateNewObjectType::getObjectTypeId('xpho');
if($orgu_type_id)
{
	$offering_admin = ilDBUpdateNewObjectType::addCustomRBACOperation( //$a_id, $a_title, $a_class, $a_pos
		'rep_robj_xpho_download_images', 'download images', 'object', 280);
	if($offering_admin)
	{
		ilDBUpdateNewObjectType::addRBACOperation($orgu_type_id, $offering_admin);
	}
}else
	throw new Exception("Please make sure that the org-unit module is correctly installed before you can continue with this step.");
?>