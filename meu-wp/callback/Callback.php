<?
class PostListener {

   private $valid = false;

   /**
    * @param array $postdata $_POST array
    */
   public function __construct(array $postdata) {
       $this->valid = $this->validatePostData($postdata);
   }

   /**
    * Runs on 'onchangeapi' action
    */
   public function __invoke() {
      if ($this->valid) {
          // do whatever you need to do 
          exit();
      }
   }

   /**
    * @param array $postdata $_POST array
    * @return bool
    */
   private function validatePostData(array $postdata) {
      // check here the $_POST data, e.g. if the post data actually comes
    
?>