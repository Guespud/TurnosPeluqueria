<?php

/*
 * SNavia
 * Playtech
 * 2013
 */

require_once  'Tools.php';
require_once  'fpdf/fpdf.php';

class GeneradorPDFs extends FPDF {

    private $widthCell = 15;
    private $heightCell = 5;
    private $fontHeader = array(
        'font' => 'Arial',
        'style' => '',
        'size' => 12
    );

    private $fontHeaderSubTitles = array(
        'font' => 'Arial',
        'style' => '',
        'size' => 9
    );

    private $axisHeaderImg = array(
        'x' => 10,
        'y' => 6,
        'w' => 30,
        'h' => 10
    );

    private $colorTitles = array(
        'r' => 0,
        'g' => 101,
        'b' => 164
    );
    private $colorSubtitles = array(
        'r' => 0,
        'g' => 101,
        'b' => 164
    );
    private $drawHeaderImg = TRUE;
    private $drawCreationDate = TRUE;
    private $titles = array();
    private $subtitles = array();

    function Header($rcParams = array()) {
        $this->AliasNbPages();
        $this->setSettings($rcParams);

        $this->SetFont($this->fontHeader['font'], $this->fontHeader['style'], $this->fontHeader['size']);
        $this->SetTextColor($this->colorTitles['r'], $this->colorTitles['g'], $this->colorTitles['b']);
        foreach ($this->titles as $title) {
            $this->Cell(0, $this->getH(), $title, 0, 1, 'C');
        }
        $this->SetTextColor(0, 0, 0);

        $this->SetFont($this->fontHeaderSubTitles['font'], $this->fontHeaderSubTitles['style'], $this->fontHeaderSubTitles['size']);
        $this->SetTextColor($this->colorSubtitles['r'], $this->colorSubtitles['g'], $this->colorSubtitles['b']);
        foreach ($this->subtitles as $subtitle) {
            $this->Cell(0, $this->getH(), $subtitle, 0, 1, 'C');
        }
        $this->SetTextColor(0, 0, 0);

        if ($this->GetY() < 25)
            $this->SetY((int) $this->axisHeaderImg['y'] + (int) $this->axisHeaderImg['h'] + 5);
    }

    function Footer() {
        $this->SetY(-10);
        $this->SetFont('Arial', 'I', 7);
        $this->Cell(0, 5, 'Pagina ' . $this->PageNo() . '/{nb}', 0, 0, 'L');

        if ($this->drawCreationDate) {
            $this->SetX($this->CurOrientation == 'P' ? 175 : 263);
            $this->Cell(0, 5, Tools::GetFullDate(), 0, 0, 'L');
        }
    }

    function Cell($w, $h = 0, $txt = '', $border = 0, $ln = 0, $align = '', $fill = false, $link = '') {
        if ($fill == false) {
            $this->SetFillColor(255, 255, 255);
            parent::Cell($w, $h, html_entity_decode(utf8_decode($txt)), $border, $ln, $align, 1, $link);
        } else {
            parent::Cell($w, $h, html_entity_decode(utf8_decode($txt)), $border, $ln, $align, $fill, $link);
        }
    }

    private function setSettings($rcParams = array()) {
        if (!is_array($rcParams) || !sizeof($rcParams))
            return;

        $rcParams = array_change_key_case($rcParams, CASE_UPPER);

        //Font Header
        if (isset($rcParams['FONT_HEADER']) && is_array($rcParams['FONT_HEADER'])) {
            if (isset($rcParams['FONT_HEADER']['font']) && is_string(isset($rcParams['FONT_HEADER']['font'])))
                $this->fontHeader['font'] = $rcParams['FONT_HEADER']['font'];

            if (isset($rcParams['FONT_HEADER']['style']) && is_string(isset($rcParams['FONT_HEADER']['style'])))
                $this->fontHeader['style'] = $rcParams['FONT_HEADER']['style'];

            if (isset($rcParams['FONT_HEADER']['size']) && is_numeric(isset($rcParams['FONT_HEADER']['size'])))
                $this->fontHeader['size'] = $rcParams['FONT_HEADER']['size'];
        }

        //Font Header Sub Titles
        if (isset($rcParams['FONT_HEADER_SUB']) && is_array($rcParams['FONT_HEADER_SUB'])) {
            if (isset($rcParams['FONT_HEADER_SUB']['font']) && is_string(isset($rcParams['FONT_HEADER_SUB']['font'])))
                $this->fontHeader['font'] = $rcParams['FONT_HEADER_SUB']['font'];

            if (isset($rcParams['FONT_HEADER_SUB']['style']) && is_string(isset($rcParams['FONT_HEADER_SUB']['style'])))
                $this->fontHeader['style'] = $rcParams['FONT_HEADER_SUB']['style'];

            if (isset($rcParams['FONT_HEADER_SUB']['size']) && is_numeric(isset($rcParams['FONT_HEADER_SUB']['size'])))
                $this->fontHeader['size'] = $rcParams['FONT_HEADER_SUB']['size'];
        }

        //Header Img
        if (isset($rcParams['DRAW_HEDAER_IMG'])) {
            $this->drawHeaderImg = $rcParams['DRAW_HEDAER_IMG'] === TRUE || $rcParams['DRAW_HEDAER_IMG'] === FALSE ? $rcParams['DRAW_HEDAER_IMG'] : TRUE;
        }

        //Creation Date
        if (isset($rcParams['DRAW_CREATION_DATE'])) {
            $this->drawHeaderImg = $rcParams['DRAW_CREATION_DATE'] === TRUE || $rcParams['DRAW_CREATION_DATE'] === FALSE ? $rcParams['DRAW_CREATION_DATE'] : TRUE;
        }

        //Titles
        if (isset($rcParams['TITLES'])) {
            $this->titles = is_array($rcParams['TITLES']) ? $rcParams['TITLES'] : array('Reporte');
        }

        //SubTitles
        if (isset($rcParams['SUBTITLES'])) {
            $this->subtitles = is_array($rcParams['SUBTITLES']) ? $rcParams['SUBTITLES'] : array();
        }

        //Titles color
        if (isset($rcParams['TITLES_COLOR'])) {
            $this->colorTitles = is_array($rcParams['TITLES_COLOR']) ? $rcParams['TITLES_COLOR'] : array();
        }

        //Subtitles color
        if (isset($rcParams['SUBTITLES_COLOR'])) {
            $this->colorSubtitles = is_array($rcParams['SUBTITLES_COLOR']) ? $rcParams['SUBTITLES_COLOR'] : array();
        }
    }

    private function _alignTo($XAxis) {
        return (($this->w - ($this->lMargin + $this->rMargin)) - $XAxis) / 2;
    }

    public function alignTo($XAxis) {
        $this->Cell($this->_alignTo($XAxis));
    }

    public function setTitles($titles) {
        $this->titles = $titles;
    }

    public function setSubTitles($subtitles) {
        $this->subtitles = $subtitles;
    }

    public function getW() {
        return $this->widthCell;
    }

    public function getH() {
        return $this->heightCell;
    }   

}

?>