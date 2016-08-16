<?php
class item{
	private $cdItem;
	private $nmItem;
	private $cdCateg;
	private $desItem;
	private $valItem;


	public function getCdItem() {
        return $this->cdItem;
    }
    public function setCdItem($item) {
        $this->cdItem = $item;
    }

    public function getNmItem() {
        return $this->nmItem;
    }
    public function setNmItem($nmItem) {
        $this->nmItem = $nmItem;
    }

    public function getCdCateg() {
        return $this->cdCateg;
    }
    public function setCdCateg($cdCateg) {
        $this->cdCateg = $cdCateg;
    }

	public function getDesItem() {
        return $this->desItem;
    }
    public function setDesItem($desItem) {
        $this->desItem = $desItem;
    }

    public function getValItem() {
        return $this->valItem;
    }
    public function setValItem($valItem) {
        $this->valItem = $valItem;
    }

}
?>