<?php
if (!empty($fields)){
    /** @var \wpai_acf_add_on\fields\Field $subField */
    foreach ($fields as $subField){
        $subField->setFieldInputName($field_name . '[' . $field['key'] . ']');
        $subField->view();
    }
}