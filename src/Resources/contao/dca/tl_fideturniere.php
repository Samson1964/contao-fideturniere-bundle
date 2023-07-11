<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2014 Leo Feyer
 *
 * @package News
 * @link    https://contao.org
 * @license http://www.gnu.org/licenses/lgpl-3.0.html LGPL
 */


/**
 * Table tl_fideturniere
 */
$GLOBALS['TL_DCA']['tl_fideturniere'] = array
(

	// Config
	'config' => array
	(
		'dataContainer'               => 'Table',
		'switchToEdit'                => true,
		'enableVersioning'            => true,
		'sql' => array
		(
			'keys' => array
			(
				'id'                 => 'primary',
			)
		)
	),

	// List
	'list' => array
	(
		'sorting' => array
		(
			'mode'                    => 1,
			'fields'                  => array('formulardatum'),
			'flag'                    => 1,
			'panelLayout'             => 'sort,filter;search,limit',
		),
		'label' => array
		(
			'fields'                  => array('formulardatum', 'nachname', 'vorname', 'geburtsdatum', 'tstamp'),
			'format'                  => '%s, %s',
			'showColumns'             => true,
			'label_callback'          => array('tl_fideturniere', 'listRecords')
		),
		'global_operations' => array
		(
			'all' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['MSC']['all'],
				'href'                => 'act=select',
				'class'               => 'header_edit_all',
				'attributes'          => 'onclick="Backend.getScrollOffset()" accesskey="e"'
			)
		),
		'operations' => array
		(
			'edit' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_fideturniere']['edit'],
				'href'                => 'act=edit',
				'icon'                => 'edit.gif',
			),
			'copy' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_fideturniere']['copy'],
				'href'                => 'act=copy',
				'icon'                => 'copy.gif',
				//'button_callback'     => array('tl_fideturniere', 'copyArchive')
			),
			'delete' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_fideturniere']['delete'],
				'href'                => 'act=delete',
				'icon'                => 'delete.gif',
				'attributes'          => 'onclick="if(!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\'))return false;Backend.getScrollOffset()"',
				//'button_callback'     => array('tl_fideturniere', 'deleteArchive')
			),
			'show' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_fideturniere']['show'],
				'href'                => 'act=show',
				'icon'                => 'show.gif'
			),
		)
	),

	// Palettes
	'palettes' => array
	(
		'__selector__'                => array('antragsteller_ungleich_person'),
		'default'                     => '{status_legend},status;{infobox_legend:hide},infobox;{formular_legend:hide},formulardatum;{antragsteller_legend},art,nachname,vorname,titel,geburtsdatum,geschlecht,email;{auftraggeber_legend},antragsteller_ungleich_person;{fide_id_legend:hide},fide_id,nuligalight;{datenschutz_legend:hide},datenschutz;{verein_legend:hide},verein;{ausweis_legend:hide},ausweis,ausweisbox,elterneinverstaendnis;{turnier_legend:hide},turnier,turnierlink;{germany_legend},germany;{bemerkungen_legend},bemerkungen;{intern_legend:hide},intern;{speedmail_legend:hide},speedmail'
	),

	// Subpalettes
	'subpalettes' => array
	(
		'antragsteller_ungleich_person' => 'nachname_person,vorname_person,email_person,'
	),

	// Fields
	'fields' => array
	(
		'id' => array
		(
			'sql'                     => "int(10) unsigned NOT NULL auto_increment"
		),
		'tstamp' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_fideturniere']['tstamp'],
			'flag'                    => 5,
			'sorting'                 => true,
			'sql'                     => "int(10) unsigned NOT NULL default '0'"
		),
		'turnierId' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_fideturniere']['turnierId'],
			'flag'                    => 5,
			'sorting'                 => true,
			'eval'                    => array
			(
				'mandatory'           => true,
				'tl_class'            => 'w50'
			),
			'sql'                     => "int(10) unsigned NOT NULL default '0'"
		),
		'name' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_fideturniere']['name'],
			'exclude'                 => true,
			'search'                  => false,
			'sorting'                 => false,
			'flag'                    => 1,
			'inputType'               => 'text',
			'eval'                    => array
			(
				'mandatory'           => true,
				'maxlength'           => 255,
				'tl_class'            => 'w50'
			),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'ueber18' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_fideturniere']['ueber18'],
			'eval'                    => array
			(
				'isBoolean'           => true
			),
			'sql'                     => "char(1) NOT NULL default ''"
		),
		'status' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_fideturniere']['status'],
			'exclude'                 => true,
			'filter'                  => true,
			'inputType'               => 'select',
			'options'                 => array(0, 1, 2, 3, 4),
			'reference'               => &$GLOBALS['TL_LANG']['tl_fideturniere']['status_optionen'],
			'eval'                    => array
			(
				'mandatory'           => true,
				'tl_class'            => 'long'
			),
			'sql'                     => "varchar(1) NOT NULL default '0'"
		),
		'infobox' => array
		(
			'exclude'                 => true,
			'input_field_callback'    => array('tl_fideturniere', 'getInfobox')
		),
		'formulardatum' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_fideturniere']['formulardatum'],
			'flag'                    => 6,
			'inputType'               => 'text',
			'eval'                    => array
			(
				'rgxp'                => 'datim',
				'mandatory'           => true,
				'doNotCopy'           => true,
				'datepicker'          => true,
				'tl_class'            => 'w50 wizard'
			),
			//'load_callback' => array
			//(
			//	array('tl_fideturniere', 'loadDate')
			//),
			'sql'                     => "int(10) unsigned NOT NULL default '0'"
		),
		'antragsteller_ungleich_person' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_fideturniere']['antragsteller_ungleich_person'],
			'inputType'               => 'checkbox',
			'filter'                  => true,
			'eval'                    => array('submitOnChange'=>true, 'tl_class'=>'clr m12'),
			'sql'                     => "char(1) NOT NULL default ''"
		),
		'vorname_person' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_fideturniere']['vorname_person'],
			'exclude'                 => true,
			'search'                  => false,
			'sorting'                 => false,
			'flag'                    => 1,
			'inputType'               => 'text',
			'eval'                    => array
			(
				'mandatory'           => true,
				'maxlength'           => 32,
				'tl_class'            => 'w50'
			),
			'sql'                     => "varchar(32) NOT NULL default ''"
		),
		'email_person' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_fideturniere']['email_person'],
			'inputType'               => 'text',
			'exclude'                 => true,
			'search'                  => false,
			'sorting'                 => false,
			'flag'                    => 1,
			'search'                  => false,
			'eval'                    => array
			(
				'mandatory'           => true,
				'maxlength'           => 255,
				'tl_class'            => 'w50',
				'rgxp'                => 'email'
			),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'art' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_fideturniere']['art'],
			'exclude'                 => true,
			'filter'                  => true,
			'sorting'                 => true,
			'flag'                    => 1,
			'inputType'               => 'select',
			'options'                 => &$GLOBALS['TL_LANG']['tl_fideturniere']['art_optionen'],
			'eval'                    => array
			(
				'mandatory'           => true,
				'includeBlankOption'  => true,
				'maxlength'           => 20,
				'tl_class'            => 'w50'
			),
			'sql'                     => "varchar(20) NOT NULL default ''"
		),
		'nachname' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_fideturniere']['nachname'],
			'exclude'                 => true,
			'search'                  => true,
			'sorting'                 => true,
			'flag'                    => 1,
			'inputType'               => 'text',
			'eval'                    => array
			(
				'mandatory'           => true,
				'maxlength'           => 32,
				'tl_class'            => 'w50 clr'
			),
			'sql'                     => "varchar(32) NOT NULL default ''"
		),
		'vorname' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_fideturniere']['vorname'],
			'exclude'                 => true,
			'search'                  => true,
			'sorting'                 => true,
			'flag'                    => 1,
			'inputType'               => 'text',
			'eval'                    => array
			(
				'mandatory'           => true,
				'maxlength'           => 32,
				'tl_class'            => 'w50'
			),
			'sql'                     => "varchar(32) NOT NULL default ''"
		),
		'titel' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_fideturniere']['titel'],
			'exclude'                 => true,
			'search'                  => false,
			'sorting'                 => false,
			'flag'                    => 1,
			'inputType'               => 'select',
			'options'                 => &$GLOBALS['TL_LANG']['tl_fideturniere']['titel_optionen'],
			'eval'                    => array
			(
				'mandatory'           => false,
				'includeBlankOption'  => true,
				'maxlength'           => 10,
				'tl_class'            => 'w50'
			),
			'sql'                     => "varchar(10) NOT NULL default ''"
		),
		'geburtsdatum' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_fideturniere']['geburtsdatum'],
			'search'                  => false,
			'sorting'                 => false,
			'flag'                    => 7,
			'inputType'               => 'text',
			'eval'                    => array
			(
				'rgxp'                => 'date',
				'mandatory'           => true,
				'doNotCopy'           => true,
				'datepicker'          => true,
				'tl_class'            => 'w50 wizard'
			),
			'load_callback' => array
			(
				array('tl_fideturniere', 'loadDate')
			),
			'sql'                     => "int(12) signed NOT NULL default 0"
		),
		'geschlecht' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_fideturniere']['geschlecht'],
			'exclude'                 => true,
			'search'                  => false,
			'sorting'                 => false,
			'filter'                  => true,
			'inputType'               => 'select',
			'options'                 => &$GLOBALS['TL_LANG']['tl_fideturniere']['geschlecht_optionen'],
			'eval'                    => array
			(
				'mandatory'           => true,
				'includeBlankOption'  => true,
				'maxlength'           => 1,
				'tl_class'            => 'w50'
			),
			'sql'                     => "varchar(1) NOT NULL default ''"
		),
		'email' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_fideturniere']['email'],
			'inputType'               => 'text',
			'exclude'                 => true,
			'search'                  => true,
			'sorting'                 => false,
			'flag'                    => 1,
			'search'                  => true,
			'eval'                    => array
			(
				'mandatory'           => false,
				'maxlength'           => 255,
				'tl_class'            => 'w50',
				'rgxp'                => 'email'
			),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'datenschutz' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_fideturniere']['datenschutz'],
			'inputType'               => 'checkbox',
			'filter'                  => true,
			'eval'                    => array
			(
				'tl_class'            => 'w50 m12',
				'isBoolean'           => true
			),
			'sql'                     => "char(1) NOT NULL default ''"
		),
		'verein' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_fideturniere']['verein'],
			'exclude'                 => true,
			'search'                  => true,
			'sorting'                 => false,
			'flag'                    => 1,
			'inputType'               => 'text',
			'eval'                    => array
			(
				'mandatory'           => false,
				'maxlength'           => 255,
				'tl_class'            => 'w50'
			),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'ausweis' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_fideturniere']['ausweis'],
			'exclude'                 => true,
			'inputType'               => 'fileTree',
			'eval'                    => array
			(
				'filesOnly'           => true, 
				'fieldType'           => 'radio', 
				'mandatory'           => false, 
				'tl_class'            => 'clr'
			),
			'sql'                     => "binary(16) NULL",
		),
		'elterneinverstaendnis' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_fideturniere']['elterneinverstaendnis'],
			'inputType'               => 'checkbox',
			'filter'                  => true,
			'eval'                    => array
			(
				'tl_class'            => 'w50 m12 clr',
				'isBoolean'           => true
			),
			'sql'                     => "char(1) NOT NULL default ''"
		),
		'ausweisbox' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_fideturniere']['ausweisbox'],
			'exclude'                 => true,
			'input_field_callback'    => array('tl_fideturniere', 'getAusweisbox')
		),
		'turnier' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_fideturniere']['turnier'],
			'exclude'                 => true,
			'search'                  => true,
			'sorting'                 => false,
			'flag'                    => 1,
			'inputType'               => 'text',
			'eval'                    => array
			(
				'mandatory'           => false,
				'maxlength'           => 255,
				'tl_class'            => 'w50'
			),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'turnierlink' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_fideturniere']['turnierlink'],
			'exclude'                 => true,
			'input_field_callback'    => array('tl_fideturniere', 'getTurnierlink')
		),
		'germany' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_fideturniere']['germany'],
			'inputType'               => 'checkbox',
			'filter'                  => true,
			'eval'                    => array
			(
				'tl_class'            => 'w50 m12',
				'isBoolean'           => true
			),
			'sql'                     => "char(1) NOT NULL default ''"
		),
		'bemerkungen' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_fideturniere']['bemerkungen'],
			'exclude'                 => true,
			'search'                  => true,
			'inputType'               => 'textarea',
			'sql'                     => "text NULL"
		),
		'fide_id' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_fideturniere']['fide_id'],
			'exclude'                 => true,
			'search'                  => true,
			'inputType'               => 'text',
			'eval'                    => array('maxlength'=>10, 'tl_class'=>'w50'),
			'sql'                     => "int(10) unsigned NOT NULL default '0'"
		),
		'nuligalight' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_fideturniere']['nuligalight'],
			'inputType'               => 'checkbox',
			'filter'                  => true,
			'eval'                    => array
			(
				'tl_class'            => 'w50 m12',
				'isBoolean'           => true
			),
			'sql'                     => "char(1) NOT NULL default ''"
		),
		'intern' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_fideturniere']['intern'],
			'exclude'                 => true,
			'search'                  => true,
			'inputType'               => 'textarea',
			'eval'                    => array('rte'=>'tinyMCE'),
			'sql'                     => "text NULL"
		),
		'speedmail' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_fideturniere']['speedmail'],
			'exclude'                 => true,
			'input_field_callback'    => array('tl_fideturniere', 'getMailbuttons'),
			'eval'                    => array
			(
				'tl_class'            => 'long'
			)
		),
	)
);


/**
 * Class tl_fideturniere
 *
 * Provide miscellaneous methods that are used by the data configuration array.
 * @copyright  Leo Feyer 2005-2014
 * @author     Leo Feyer <https://contao.org>
 * @package    News
 */
class tl_fideturniere extends Backend
{

	/**
	 * Import the back end user object
	 */
	public function __construct()
	{
		parent::__construct();
		$this->import('BackendUser', 'User');
	}

	public function getInfobox(DataContainer $dc)
	{

		$arrOptions = array
		(
			'validChars' => 'A-Za-z0-9',
			'locale'     => 'de',
			'delimiter'  => '-'
		);
		$nachname = \Contao\System::getContainer()->get('contao.slug')->generate($dc->activeRecord->nachname, $arrOptions);  
		$vorname = \Contao\System::getContainer()->get('contao.slug')->generate($dc->activeRecord->vorname, $arrOptions);  

		$ausgabe = $nachname.', ';
		$ausgabe .= $vorname;
		if($dc->activeRecord->titel) $ausgabe .= ', '.$dc->activeRecord->titel;
		$ausgabe .= '; ';
		$ausgabe .= date('Y-m-d', $dc->activeRecord->geburtsdatum).'; ';
		switch($dc->activeRecord->geschlecht)
		{
			case 'W':
				$ausgabe .= 'F';
				break;
			default:
				$ausgabe .= $dc->activeRecord->geschlecht;
		}
		
		$string = '
<div class="widget long">
  <p><b>'.$ausgabe.'</b></p>
</div>';

		return $string;
	}

	public function getTurnierlink(DataContainer $dc)
	{
		
		$string = '<div class="w50 widget">
  <h3></h3>
  <p><a href="https://ratings.fide.com/rated_tournaments.phtml?country=GER" target="_blank">Registrierte Turniere bei der FIDE</a></p>
</div>';

		return $string;
	}

	/**
	 * Vorschau und Links auf die angehängte Datei
	 * @param array
	 * @return string
	 */
	public function getAusweisbox(DataContainer $dc)
	{

		$ausgabe = '';
		if($dc->activeRecord->ausweis)
		{
			$file = \FilesModel::findByUuid($dc->activeRecord->ausweis);
			// Vorschau anzeigen
			if($file->extension == 'pdf')
			{
				$ausgabe .= self::PDFtoJPG($file->path);
			}
			elseif($file->extension == 'jpg' || $file->extension == 'png' || $file->extension == 'gif')
			{
				$ausgabe .= '<a href="'.$file->path.'" target="_blank">';
				$ausgabe .= '<img src="'.$file->path.'" style="max-width:800px;">';
				$ausgabe .= '</a><br>';
			}
			// Link anzeigen
			$ausgabe .= 'Download: <a href="'.$file->path.'" target="_blank">'.$file->name.'</a>';
		}
				
		$string = '
<div class="widget long clr">
  <h3 style="margin-bottom:10px;"><label for="ctrl_ausweisbox">'.$GLOBALS['TL_LANG']['tl_fideturniere']['ausweisbox'][0].'</label></h3>
  <p><b>'.$ausgabe.'</b></p>
  <p class="tl_help tl_tip" title="">'.$GLOBALS['TL_LANG']['tl_fideturniere']['ausweisbox'][1].'</p>
</div>';

		return $string;
	}

	/**
	 * Datensätze auflisten
	 * @param array
	 * @return string
	 */
	public function listRecords($row, $label, \DataContainer $dc, $args)
	{
		// Farben festlegen
		$farbe = array(
			'0' => '#FF0000',
			'1' => '#0000FF',
			'2' => '#0000FF',
			'3' => '#0000FF',
			'4' => '#008000',
		);
		// Farbe für Zeile setzen
		for($x = 0; $x < count($args); $x++)
		{
			$args[$x] = '<span style="color:'.$farbe[$row['status']].';">'.$args[$x].'</span>';
		}

		// Datensatz komplett zurückgeben
		return $args;
	}


	/**
	 * Set the timestamp to 00:00:00 (see #26)
	 *
	 * @param integer $value
	 *
	 * @return integer
	 */
	public function loadDate($value)
	{
		if($value) return strtotime(date('Y-m-d', $value) . ' 00:00:00');
		else return '';
	}

	function PDFtoJPG($file)
	{
		$content = '';

		if (!extension_loaded('imagick'))
		{
			$content = $GLOBALS['TL_LANG']['tl_fideturniere']['imagickNotInstalled'];
			return $content;
		}

		$pdf = new \Imagick($file);
		$anzahlDerSeiten = $pdf->getNumberImages();
		
		for ($i = 0; $i < $anzahlDerSeiten; $i++) {
		
			$image = new \Imagick();
			
			$image->setResolution(400,400);
			$image->readImage($file."[".$i."]" );
			
			$image->setBackgroundColor('white');
			$image->setImageAlphaChannel(imagick::ALPHACHANNEL_DEACTIVATE );
			$image->setImageFormat('jpg');
			$image->scaleImage(1200, 1200, true);
			
			
			$thumbnail = base64_encode($image->getImage());
			$content .= 'Seite '.($i+1).'<br>';
			$content .= '<a href="'.$file.'" target="_blank">';
			$content .= '<img src="data:image/jpg;base64,'.$thumbnail.'">';
			$content .= '</a><br>';

			$image->clear();
			$image->destroy();
			
		}
		return $content;
	}

	public function toggleEmail($row, $href, $label, $title, $icon, $attributes)
	{
		// E-Mail-Datensatz einlesen
		$emails = \Database::getInstance()->prepare("SELECT * FROM tl_fideturniere_mails WHERE pid=?")
		                                  ->execute($row['id']);

		// E-Mails zählen
		$gesamt = 0;
		$versendet = 0;
		if($emails->numRows)
		{
			while($emails->next())
			{
				$gesamt += 1;
				$versendet += $emails->sent_state ? 1 : 0;
			}
		}
		
		$href .= '&amp;id='.$row['id'];

		if($gesamt > 0 && $gesamt != $versendet)
		{
			// Nicht alle versendet
			$icon = 'bundles/contaofideturniere/images/email_rot.png';
			$title .= sprintf($GLOBALS['TL_LANG']['tl_fideturniere']['emailbox_offen'], ($gesamt - $versendet), $versendet);
		}
		elseif($gesamt > 0 && $gesamt == $versendet)
		{
			// Alle versendet
			$icon = 'bundles/contaofideturniere/images/email_gelb.png';
			$title .= sprintf($GLOBALS['TL_LANG']['tl_fideturniere']['emailbox_versendet'], $gesamt);
		}
		else
		{
			// Keine E-Mails
			$icon = 'bundles/contaofideturniere/images/email_grau.png';
			$title .= $GLOBALS['TL_LANG']['tl_fideturniere']['emailbox_leer'];
		}

		return '<a href="'.$this->addToUrl($href).'" title="'.specialchars($title).'"'.$attributes.'>'.\Image::getHtml($icon, $label).'</a> ';
	}

	/**
	 * Buttons zur schnellen E-Mail-Übermittlung anzeigen
	 * @param DataContainer $dc
	 *
	 * @return string HTML-Code
	 */
	public function getMailbuttons(DataContainer $dc)
	{
		$css = "display:inline-block; background: linear-gradient(to top, #ccc, #eee); border: 1px solid #aaa; border-radius: 3px; color: #555; cursor: pointer; text-shadow: 1px 1px 0 #eee; padding: 4px; margin-bottom:3px;";
		
		// Link generieren
		$link = str_replace('&amp;act=edit', '', \Controller::addToUrl('key=getMailbuttons&rt='.REQUEST_TOKEN)); // key hinzufügen | edit löschen

		// Templates einlesen
		$tpl = \Database::getInstance()->prepare("SELECT * FROM tl_fideturniere_templates WHERE published=? AND speedbutton=?")
		                               ->execute(1, 1);

		$content = '<div class="widget">';
		$content .= '<h3><label for="ctrl_getmailbuttons">'.$GLOBALS['TL_LANG']['tl_fideturniere']['speedmail'][0].'</label></h3>';
		if($tpl->numRows)
		{
			while($tpl->next())
			{
				$content .= '<div style="border:0; margin-bottom:20px;"><a href="'.$link.'&template='.$tpl->id.'&antrag='.$dc->activeRecord->id.'" style="'.$css.'" onclick="if(!confirm(\'Soll die E-Mail wirklich versendet werden?\'))return false;Backend.getScrollOffset()">'.$tpl->buttonname.'</a>';
				$content .= '<p class="tl_help tl_tip" style="font-size:.75rem;" title="">'.$tpl->buttontip.'</p></div>';
			}
		}
		$content .= '</div>';

		return $content;
	}


}
