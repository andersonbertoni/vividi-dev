<?php
if (!$is_public){
    unset($args['name']);
    $args['other_args'] = 'onChange="ihcWriteTagValue(this, \'#indeed-user-level-free-select\', \'#ihc-select-level-view-values\', \'ihc-level-select-v-\');"';
}
?>
<div class="iump-form-line iump-special-line">
    <label class="iump-labels"><?php _e('Select Level:', 'ihc');?></label>
    <?php echo indeed_create_form_element($args);?>
    <?php if (!$is_public):?>
      <?php echo indeed_create_form_element(array('type'=>'hidden', 'name'=>'ihc_user_levels', 'id' => 'indeed-user-level-free-select', 'value' => $user_levels ));?>
      <div id="ihc-select-level-view-values">
          <?php if ($userLevelsArray):?>
              <?php foreach ($userLevelsArray as $lid):?>
                <?php
                $lid = (int)$lid;
                $levelData = ihc_get_level_by_id($lid);
                if (empty($levelData)){
                    continue;
                }
                ?>
                <div id="<?php echo 'ihc-level-select-v-' . $lid;?>" class="ihc-tag-item"><?php echo $levelData['name'];?>
                    <div class="ihc-remove-tag" onclick="ihcremoveTag(<?php echo $lid;?>, '#ihc-level-select-v-', '#indeed-user-level-free-select');ihcAdminDeleteUserLevelRelationship(<?php echo $lid;?>, <?php echo $uid;?>);" title="<?php _e('Removing tag', 'ihc');?>">
                        x
                    </div>
                </div>
              <?php endforeach;?>
          <?php endif;?>
      </div>
      <div class="clear"></div>
    <?php endif;?>
</div>
