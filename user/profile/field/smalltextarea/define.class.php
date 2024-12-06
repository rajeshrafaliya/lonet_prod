<?php
class profile_define_smalltextarea extends profile_define_base {

    /**
     * Add elements for creating/editing a textarea profile field.
     * @param moodleform $form
     */
    public function define_form_specific($form) {
        // Default data.
        $form->addElement('text', 'defaultdata', get_string('profiledefaultdata', 'admin'), 'size="255"');
        $form->setType('defaultdata', PARAM_TEXT);
		
        // Param 2 for text type is the maxlength of the field.
        $form->addElement('text', 'param2', get_string('profilefieldmaxlength', 'admin'), 'size="6"');
        $form->setDefault('param2', 255);
        $form->setType('param2', PARAM_INT);
    }

    /**
     * Returns an array of editors used when defining this type of profile field.
     * @return array
     */
    public function define_editors() {
        return array('defaultdata');
    }
}