<link href="<?php echo ASSETS_PATH; ?>uploadify/uploadify.css" rel="stylesheet" type="text/css"/>
<?php
$moduleTablename = "tbl_slideshow"; // Database table name
$moduleId = 4;                // module id >>>>> tbl_modules
$position = array(1 => 'First', 2 => 'Second', 3 => 'Third', 4 => 'Four', 5 => 'Five');
$type= array(1=>'Image', 2=>'Video');

if (isset($_GET['page']) && $_GET['page'] == "slideshow" && isset($_GET['mode']) && $_GET['mode'] == "list"):
    clearImages($moduleTablename, "slideshow");
    clearImages($moduleTablename, "slideshow/thumbnails");
    clearImages($moduleTablename, "slideshow/video","source_vid");
    foreach($type as $key => $s_id){
        $u_type_id= $key;
    }
    $typeid= (!empty($session->get('type_id')))? $session->get('type_id'): 1;
    ?>
    <h3>
        List Slideshow
        <?php 
        if(! empty($type)) {
                
            $hotel_select_html = '<div class="pad0L col-md-3"><select class="user-hotel-select">';
            foreach ($type as $key => $types ) {
                $hotel_select_html .= '<option value="' . $key . '" ' . ($key == $typeid ? ' selected' : '') . '>' . $types . '</option>';
            }
            $hotel_select_html .= '</select></div>';
            echo $hotel_select_html;
        }
        ?>
        <a class="loadingbar-demo btn medium bg-blue-alt float-right" href="javascript:void(0);"
           onClick="AddNewSlideshow();">
    <span class="glyph-icon icon-separator">
    	<i class="glyph-icon icon-plus-square"></i>
    </span>
            <span class="button-content"> Add New </span>
        </a>
    </h3>
    <div class="my-msg"></div>
    <div class="example-box">
        <div class="example-code">
            <table cellpadding="0" cellspacing="0" border="0" class="table" id="example">
                <thead>
                <tr>
                    <th style="display:none;"></th>
                    <th class="text-center"><input class="check-all" type="checkbox"/></th>
                    <th>Title</th>
                    <th>Link</th>
                    <th class="text-center"><?php echo $GLOBALS['basic']['action']; ?></th>
                </tr>
                </thead>

                <tbody>
                <?php $records = Slideshow::find_by_sql("SELECT * FROM " . $moduleTablename . " WHERE mode= $typeid ORDER BY sortorder DESC ");
                foreach ($records as $key => $record): ?>
                    <tr id="<?php echo $record->id; ?>">
                        <td style="display:none;"><?php echo $key + 1; ?></td>
                        <td><input type="checkbox" class="bulkCheckbox" bulkId="<?php echo $record->id; ?>"/></td>
                        <td>
                            <div class="col-md-7">
                                <a href="javascript:void(0);" onClick="editRecord(<?php echo $record->id; ?>);"
                                   class="loadingbar-demo"
                                   title="<?php echo $record->title; ?>"><?php echo $record->title; ?></a>
                            </div>
                        </td>
                        <td><?php echo set_na($record->linksrc); ?></td>
                        <td class="text-center">
                            <?php
                            $statusImage = ($record->status == 1) ? "bg-green" : "bg-red";
                            $statusText = ($record->status == 1) ? $GLOBALS['basic']['clickUnpub'] : $GLOBALS['basic']['clickPub'];
                            ?>
                            <a href="javascript:void(0);"
                               class="btn small <?php echo $statusImage; ?> tooltip-button statusToggler"
                               data-placement="top" title="<?php echo $statusText; ?>"
                               status="<?php echo $record->status; ?>" id="imgHolder_<?php echo $record->id; ?>"
                               moduleId="<?php echo $record->id; ?>">
                                <i class="glyph-icon icon-flag"></i>
                            </a>
                            <a href="javascript:void(0);" class="loadingbar-demo btn small bg-blue-alt tooltip-button"
                               data-placement="top" title="Edit" onclick="editRecord(<?php echo $record->id; ?>);">
                                <i class="glyph-icon icon-edit"></i>
                            </a>
                            <a href="javascript:void(0);" class="btn small bg-red tooltip-button" data-placement="top"
                               title="Remove" onclick="recordDelete(<?php echo $record->id; ?>);">
                                <i class="glyph-icon icon-remove"></i>
                            </a>
                            <input name="sortId" type="hidden" value="<?php echo $record->id; ?>">
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="pad0L col-md-2">
            <select name="dropdown" id="groupTaskField" class="custom-select">
                <option value="0"><?php echo $GLOBALS['basic']['choseAction']; ?></option>
                <option value="delete"><?php echo $GLOBALS['basic']['delete']; ?></option>
                <option value="toggleStatus"><?php echo $GLOBALS['basic']['toggleStatus']; ?></option>
            </select>
        </div>
        <a class="btn medium primary-bg" href="javascript:void(0);" id="applySelected_btn">
        <span class="glyph-icon icon-separator float-right">
          <i class="glyph-icon icon-cog"></i>
        </span>
            <span class="button-content"> Click </span>
        </a>
    </div>

<?php elseif (isset($_GET['mode']) && $_GET['mode'] == "addEdit"):
    if (isset($_GET['id']) && !empty($_GET['id'])):
        $advId = addslashes($_REQUEST['id']);
        $advInfo = Slideshow::find_by_id($advId);

        $status = ($advInfo->status == 1) ? "checked" : " ";
        $unstatus = ($advInfo->status == 0) ? "checked" : " ";

        $external = ($advInfo->linktype == 1) ? "checked" : " ";
        $internal = ($advInfo->linktype == 0) ? "checked" : " ";

        $addtype = ($advInfo->type == 1) ? "checked" : " ";
        $unaddtype = ($advInfo->type == 0) ? "checked" : " ";

        $imghide = ($advInfo->type == 0) ? 'hide' : ' ';
        $videohide = ($advInfo->type == 1) ? 'hide' : ' ';
    endif;
    $typeid= (!empty($session->get('type_id')))? $session->get('type_id'): 1;
    ?>
    <h3>
        <?php echo (isset($_GET['id'])) ? 'Edit Slideshow' : 'Add Slideshow'; ?>
        <a class="loadingbar-demo btn medium bg-blue-alt float-right" href="javascript:void(0);"
           onClick="viewSlideshowlist();">
    <span class="glyph-icon icon-separator">
    	<i class="glyph-icon icon-arrow-circle-left"></i>
    </span>
            <span class="button-content"> Back </span>
        </a>
    </h3>

    <div class="my-msg"></div>
    <div class="example-box">
        <div class="example-code">
            <form action="" class="col-md-12 center-margin" id="slideshow_frm">
            <input name="mode" type="hidden" value="<?php echo $typeid ?>">
                <div class="form-row">
                    <div class="form-label col-md-2">
                        <label for="">
                            Title :
                        </label>
                    </div>
                    <div class="form-input col-md-8">
                        <input placeholder="Slideshow Title" class="col-md-6 validate[required,length[0,50]]"
                               type="text" name="title" id="title"
                               value="<?php echo !empty($advInfo->title) ? $advInfo->title : ""; ?>">
                    </div>
                </div>
                <?php if($typeid==1){?>
                <div class="form-row">
                    <div class="form-label col-md-2">
                        <label for="">
                            Image :
                        </label>
                    </div>

                    <?php if (!empty($advInfo->image)): ?>
                        <div class="col-md-3" id="removeSavedimg1">
                            <div class="infobox info-bg">
                                <div class="button-group" data-toggle="buttons">
                            <span class="float-left">
                                <?php
                                if (file_exists(SITE_ROOT . "images/slideshow/" . $advInfo->image)):
                                    $filesize = filesize(SITE_ROOT . "images/slideshow/" . $advInfo->image);
                                    echo 'Size : ' . getFileFormattedSize($filesize);
                                endif;
                                ?>
                            </span>
                                    <a class="btn small float-right" href="javascript:void(0);"
                                       onclick="deleteSavedSlideshowimage(1);">
                                        <i class="glyph-icon icon-trash-o"></i>
                                    </a>
                                </div>
                                <img src="<?php echo IMAGE_PATH . 'slideshow/thumbnails/' . $advInfo->image; ?>"
                                     style="width:100%"/>
                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="form-input col-md-10 uploader1 <?php echo !empty($advInfo->image) ? "hide" : ""; ?>">
                        <input type="file" name="background_upload" id="background_upload"
                               class="transparent no-shadow">
                               <label>
                        <small>Image Dimensions (<?php echo Module::get_properties($moduleId, 'imgwidth'); ?> px
                            X <?php echo Module::get_properties($moduleId, 'imgheight'); ?> px)
                        </small>
                    </label>
                    </div>
                    <!-- Upload user image preview -->
                    <div id="preview_Image"><input type="hidden" name="imageArrayname" value="" class=""/></div>
                </div>
                <?php }
                else{?>
                <div class="form-row">
                    <div class="form-label col-md-2">
                        <label for="">
                            Add Type :
                        </label>
                    </div>
                    <div class="form-checkbox-radio col-md-9">
                        <input type="radio" class="custom-radi addtype" name="type" id="adtype1"
                               value="1" <?php echo !empty($addtype) ? $addtype : "checked"; ?>>
                        <label for="">youtube link</label>
                        <input type="radio" class="custom-radi addtype" name="type" id="adtype0"
                               value="0" <?php echo !empty($unaddtype) ? $unaddtype : ""; ?>>
                        <label for="">Video upload</label>
                    </div>
                </div>

                <div class="form-row add-image <?php echo !empty($imghide) ? $imghide : ''; ?>">
                    <div class="form-row">
                    <div class="form-label col-md-2">
                        <label for="">
                            Video link :
                        </label>
                    </div>
                    <div class="form-input col-md-10">
                        <input placeholder="http://www.youtube.com/watch?v=fs2khSNtSu0" class="col-md-8 validate[required,custom[url]]" type="text" name="source" id="source" value="<?php echo !empty($advInfo->source) ? $advInfo->source : ""; ?>">
                        <input type="hidden" name="url_type" id="url_type">
                       
                         </button>
                        <small>
                            <br/>Ex. Soundcloud : http://soundcloud.com/balajipatturaj/chennais-super-kings-with-rj
                            <br/>Ex. Youtube : https://www.youtube.com/watch?v=dZpc936_Hgo
                            <br/>Ex. Vimeo : http://vimeo.com/65484727
                            <br/>Ex. Metacafe : http://www.metacafe.com/watch/10599819/are_katy_perry_and_john_mayer_back_together
                            <br/>Ex. Dailymotion : http://www.dailymotion.com/video/xzdijh_hire-data-entry-expert_news
                        </small>
                    </div>
                </div>
           
                </div> 
                </div>

                <div class="form-row <?php echo !empty($videohide) ? $videohide : '';
                echo isset($_GET['id']) ? '' : 'hide'; ?> videolink">
                    <div class="form-label col-md-2">
                        <label for="">
                            Video :
                        </label>
                    </div>
                    <style>
                        .word-break p {
                            white-space: pre-wrap;
                            white-space: -moz-pre-wrap;
                            white-space: -o-pre-wrap;
                            word-wrap: break-word;
                        }
                    </style>
                    <?php if (!empty($advInfo->source_vid)): ?>
                        <div class="col-md-3" id="removeSavedimg2">
                            <div class="infobox info-bg">
                                <div class="button-group" data-toggle="buttons">
                                    <span class="word-break">
                                        <?php
                                        if (file_exists(SITE_ROOT . "images/slideshow/video/" . $advInfo->source_vid)):
                                            $filesize = filesize(SITE_ROOT . "images/slideshow/video/" . $advInfo->source_vid);
                                            echo '<p>' . $advInfo->source_vid . '</p>';
                                            echo '<br>Size : ' . getFileFormattedSize($filesize);
                                        endif;
                                        ?>
                                    </span>
                                    <a class="btn small float-right" href="javascript:void(0);"
                                       onclick="deleteSavedSlideshowimage(2);">
                                        <i class="glyph-icon icon-trash-o"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="form-input col-md-10 uploader2 <?php echo !empty($advInfo->source_vid) ? "hide" : ""; ?>">
                        <input type="file" name="vid_upload" id="vid_upload"
                               class="transparent no-shadow">
                        <label>
                            <small> Upload .mp4 or .m4v files only</small>
                        </label>
                    </div>
                    <div id="preview_Video">
                        <input type="hidden" name="videoArrayname" value="<?php echo !empty($advInfo->source_vid) ? $advInfo->source_vid : ""; ?>" class=""/>
                    </div>
                </div>
                
                <?php }?>

                <div class="form-row">
                    <div class="form-label col-md-2">
                        <label for="">
                            Link Type :
                        </label>
                    </div>
                    <div class="form-checkbox-radio col-md-9">
                        <input id="" class="custom-radi" type="radio" name="linktype" value="0"
                               onClick="linkTypeSelect(0);" <?php echo !empty($internal) ? $internal : "checked"; ?>>
                        <label for="">Internal Link</label>
                        <input id="" class="custom-radi" type="radio" name="linktype" value="1"
                               onClick="linkTypeSelect(1);" <?php echo !empty($external) ? $external : ""; ?>>
                        <label for="">External Link</label>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-label col-md-2">
                        <label for="">
                            Link :
                        </label>
                    </div>
                    <div class="form-input col-md-8">
                        <div class="col-md-4" style="padding-left:0px !important;">
                            <input placeholder="Slideshow Link" class="" type="text" name="linksrc" id="linksrc"
                                   value="<?php echo !empty($advInfo->linksrc) ? $advInfo->linksrc : ""; ?>">
                        </div>
                        <div class="col-md-6" style="padding-left:0px !important;">
                            <?php $Lpageview = !empty($advInfo->linksrc) ? $advInfo->linksrc : "";
                            $lnktype = !empty($advInfo->linktype) ? $advInfo->linktype : ""; ?>
                            <select data-placeholder="Select Link Page"
                                    class="col-md-4 chosen-select <?php echo ($lnktype == 1) ? 'hide' : ''; ?>"
                                    id="linkPage">
                                <option value=""></option>
                                <?php echo Article::get_internal_link($Lpageview, $lnktype); ?>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-label col-md-2">
                        <label for="">
                            Short Content :
                        </label>
                    </div>
                    <div class="form-input col-md-8">
                        <textarea name="content" id="content"
                                  class="large-textarea"><?php echo !empty($advInfo->content) ? $advInfo->content : ""; ?></textarea>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-label col-md-2">
                        <label for="">
                            Status :
                        </label>
                    </div>
                    <div class="form-checkbox-radio col-md-9">
                        <input type="radio" class="custom-radi" name="status" id="check1"
                               value="1" <?php echo !empty($status) ? $status : "checked"; ?>>
                        <label for="">Published</label>
                        <input type="radio" class="custom-radi" name="status" id="check0"
                               value="0" <?php echo !empty($unstatus) ? $unstatus : ""; ?>>
                        <label for="">Un-Published</label>
                    </div>
                </div>
                <button btn-action='0' type="submit" name="submit"
                        class="btn-submit btn large primary-bg text-transform-upr font-bold font-size-11 radius-all-4"
                        id="btn-submit" title="Save">
                <span class="button-content">
                    Save
                </span>
                </button>
                <button btn-action='1' type="submit" name="submit"
                        class="btn-submit btn large primary-bg text-transform-upr font-bold font-size-11 radius-all-4"
                        id="btn-submit" title="Save">
                <span class="button-content">
                    Save & More
                </span>
                </button>
                <button btn-action='2' type="submit" name="submit"
                        class="btn-submit btn large primary-bg text-transform-upr font-bold font-size-11 radius-all-4"
                        id="btn-submit" title="Save">
                <span class="button-content">
                    Save & quit
                </span>
                </button>
                <input myaction='0' type="hidden" name="idValue" id="idValue"
                       value="<?php echo !empty($advInfo->id) ? $advInfo->id : 0; ?>"/>
            </form>
        </div>
    </div>

    <script type="text/javascript" src="<?php echo ASSETS_PATH; ?>uploadify/jquery.uploadify.min.js"></script>
    <script type="text/javascript">
        // <![CDATA[
        $(document).ready(function () {
            $('#background_upload').uploadify({
                'swf': '<?php echo ASSETS_PATH;?>uploadify/uploadify.swf',
                'uploader': '<?php echo ASSETS_PATH;?>uploadify/uploadify.php',
                'formData': {
                    PROJECT: '<?php echo SITE_FOLDER;?>',
                    targetFolder: 'images/slideshow/',
                    thumb_width: 200,
                    thumb_height: 200
                },
                'method': 'post',
                'cancelImg': '<?php echo BASE_URL;?>uploadify/cancel.png',
                'auto': true,
                'multi': false,
                'hideButton': false,
                'buttonText': 'Upload Image',
                'width': 125,
                'height': 21,
                'removeCompleted': true,
                'progressData': 'speed',
                'uploadLimit': 100,
                'fileTypeExts': '*.gif; *.jpg; *.jpeg;  *.png; *.GIF; *.JPG; *.JPEG; *.PNG;',
                'buttonClass': 'button formButtons',
                /* 'checkExisting' : '/uploadify/check-exists.php',*/
                'onUploadSuccess': function (file, data, response) {
                    $('#uploadedImageName').val('1');
                    var filename = data;
                    $.post('<?php echo BASE_URL;?>apanel/slideshow/uploaded_image.php', {imagefile: filename}, function (msg) {
                        $('#preview_Image').html(msg).show();
                    });

                },
                'onDialogOpen': function (event, ID, fileObj) {
                },
                'onUploadError': function (file, errorCode, errorMsg, errorString) {
                    alert(errorMsg);
                },
                'onUploadComplete': function (file) {
                    //alert('The file ' + file.name + ' was successfully uploaded');
                }
            });
        });
        $('#vid_upload').uploadify({
                'swf': '<?php echo ASSETS_PATH;?>uploadify/uploadify.swf',
                'uploader': '<?php echo ASSETS_PATH;?>uploadify/uploadify_vid.php',
                'formData': {
                    PROJECT: '<?php echo SITE_FOLDER;?>',
                    targetFolder: 'images/slideshow/video/'
                },
                'method': 'post',
                'cancelImg': '<?php echo BASE_URL;?>uploadify/cancel.png',
                'auto': true,
                'multi': false,
                'hideButton': false,
                'buttonText': 'Upload Video',
                'width': 125,
                'height': 21,
                'removeCompleted': true,
                'progressData': 'speed',
                'uploadLimit': 100,
                'fileTypeExts': '*.mp4; *.MP4;',
                'buttonClass': 'button formButtons',
                /* 'checkExisting' : '/uploadify/check-exists.php',*/
                'onUploadSuccess': function (file, data, response) {
                    var filename = data;
                    $.post('<?php echo BASE_URL;?>apanel/slideshow/uploaded_video.php', {vidfile: filename}, function (msg) {
                        $('#preview_Video').html(msg).show();
                    });
                },
                'onDialogOpen': function (event, ID, fileObj) {
                },
                'onUploadError': function (file, errorCode, errorMsg, errorString) {
                    alert(errorMsg);
                },
                'onUploadComplete': function (file) {
                    //alert('The file ' + file.name + ' was successfully uploaded');
                }
            });
        // ]]>
    </script>
    <script>
        $(document).ready(function () {
            /************************************ Editor for message *****************************************/
            var base_url = "<?php echo ASSETS_PATH; ?>";
            CKEDITOR.replace('content', {
                toolbar:
                    [
                        {
                            name: 'document',
                            items: ['Source', '-', 'Save', 'NewPage', 'DocProps', 'Preview', 'Print', '-', 'Templates']
                        },
                        {name: 'styles', items: ['Styles', 'Format', 'Font', 'FontSize']}, '/',
                        {name: 'colors', items: ['TextColor', 'BGColor']},
                        {name: 'tools', items: ['Maximize', 'ShowBlocks', '-', 'About']}
                    ]
            });
        });
    </script>
<?php endif; ?>