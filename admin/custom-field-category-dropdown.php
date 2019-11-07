<div class="col-md-4">
    <div class="btn-group quickad-services-holder quickad-margin-top-screenxs-sm">
        <button class="btn btn-default btn-block dropdown-toggle quickad-flexbox" data-toggle="dropdown">
            <div class="quickad-flex-cell">
                <i class="glyphicon glyphicon-tag quickad-margin-right-md"></i>
            </div>
            <div class="quickad-flex-cell text-left" style="width: 100%">
                <span class="quickad-js-count">No category selected</span>
            </div>
            <div class="quickad-flex-cell"><div class="quickad-margin-left-md"><span class="caret"></span></div></div>
        </button>
        <ul class="dropdown-menu quickad-entity-selector" style="overflow-y: scroll;height: 300px">
            <li>
                <a class="checkbox checkbox-success" href="#">
                    <input type="checkbox" class="quickad-check-all-entities" value="any">
                    <label>All Category </label>
                </a>
            </li>
            <?php
            $cat =  get_maincategory();
            foreach($cat as $option)
            {
                $catid = $option['id'];
                ?>
                <li class="main-category">
                    <a class="checkbox checkbox-success" href="#">
                        <input type="checkbox" class="quickad-js-check-entity"  value="<?php echo $option['id'] ?>" data-title="<?php echo $option['name'] ?>">
                        <label><i class="<?php echo $option['icon'] ?>"></i> <?php echo $option['name'] ?></label>
                    </a>
                    <ul style="margin-left: 28px;">
                        <?php
                        $subcat =  get_subcat_of_maincat($catid);
                        foreach($subcat as $sub){
                            ?>
                            <li class="subcategory">
                                <a class="checkbox checkbox-success" href="#">
                                    <input type="checkbox" class="quickad-js-check-sub-entity" value="<?php echo $sub['id'] ?>" data-title="<?php echo $sub['name'] ?>">
                                    <label><?php echo $sub['name'] ?><?php echo $sub['id'] ?></label>
                                </a>
                            </li>
                            <?php
                        }
                        ?>
                    </ul>
                </li>
                <?php
            }
            ?>

        </ul>


    </div>
    <?php
    if(get_option("userlangsel") == '1'){
    ?>
    <button type="button" class="btn btn-sm btn-warning quickad_language_translation" data-custom-field-id="" data-category-type="custom-field"> <span class="ladda-label"><i class="fa fa-language"></i> Language Translation</span></button>
    <?php } ?>
</div>

