<?php
class profile_field_smalltextarea extends profile_field_base {

    /**
     * Adds elements for this field type to the edit form.
     * @param moodleform $mform
     */
    public function edit_field_add($mform) {
        $maxlength = $this->field->param2;
		
        // Create the form field.
        $mform->addElement('textarea', $this->inputname, format_string($this->field->name), 'maxlength="'.$maxlength.'" wrap="virtual" rows="5" style="width:100%;"');
        $mform->setType($this->inputname, PARAM_TEXT); // We MUST clean this before display!
    }

    /**
     * Display the data for this field
     * @return string
     */
    public function display_data() {
        $data = parent::display_data();
        return $data;
    }

    /**
     * Return the field type and null properties.
     * This will be used for validating the data submitted by a user.
     *
     * @return array the param type and null property
     * @since Moodle 3.2
     */
    public function get_field_properties() {
        return array(PARAM_RAW, NULL_NOT_ALLOWED);
    }
}


