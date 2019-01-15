<?php

namespace AppBundle\Service;

abstract class BaseService {

    protected $em;

    /**
     * This method need to be implemented by the child class
     * returning for example $this->em->getRepository('SystemBundle:Entity')
     */
    protected abstract function getRepository();

    /**
     * This method is used to persist the entity in the database using their repository.
     */
    protected function saveOrUpdate($entity) {
        if (!$entity->getId()) {
            $entity = $this->em->persist($entity);
            $entity = $this->em->flush();
        } else {
            $entity = $this->em->flush();
        }

        return $entity;
    }

    protected function delete($entity){

      try {

          if($entity){
              $this->em->remove($entity);
              $this->em->flush();
          }

      }catch(\Exception $e){
          throw new \Exception($e->getMessage());
      }

    }

    public function listAll() {
		return $this->getRepository()->findAll();
	}

	public function find($id) {
		return $this->getRepository()->find($id);
	}

  private function crypto_rand_secure($min, $max)
  {
    $range = $max - $min;
    if ($range < 1) return $min; // not so random...
    $log = ceil(log($range, 2));
    $bytes = (int) ($log / 8) + 1; // length in bytes
    $bits = (int) $log + 1; // length in bits
    $filter = (int) (1 << $bits) - 1; // set all lower bits to 1
    do {
        $rnd = hexdec(bin2hex(openssl_random_pseudo_bytes($bytes)));
        $rnd = $rnd & $filter; // discard irrelevant bits
    } while ($rnd > $range);
    return $min + $rnd;
  }

  public function getToken($length)
  {
    $token = "";
    $codeAlphabet = "";
    $codeAlphabet.= "";
    $codeAlphabet.= "123456789";
    $max = strlen($codeAlphabet); // edited

    for ($i=0; $i < $length; $i++) {
        $token .= $codeAlphabet[$this->crypto_rand_secure(0, $max-1)];
    }

    return $token;
  }

}
