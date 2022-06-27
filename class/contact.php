<?php
class ContactForm extends Model{
    public function __construct(){
        Model::__construct();
        $this->table('contactForm');
    }

    public function addContactForm($data, $is_die = false){
        return $this->insert($data, $is_die);
    }
}
?>