<?php
namespace App\Importe\Service;

use App\Importe\Entity\Immobilie;
use App\Importe\Entity\XmlData;

class XmlParser
{
    
    function __construct() {
        
    }

    function xmlParser(String $xmlfile)
    {   
        $data = new XmlData();   

        if (!file_exists($xmlfile)) 
        {
            throw new \Exception('File dont exist.');
        } else 
        {
            echo "Xml-file = $xmlfile handling beginn\n";

            $xml = simplexml_load_file($xmlfile);
            // shared infos
            $data->firma = $xml->anbieter->firma->__toString();
            //$uebertragung = $xml->uebertragung->attributes()['umfang'];
            //$umfang = isset($uebertragung['umfang']) ? $uebertragung['umfang'] : '';
            $data->umfang = $xml->uebertragung->attributes()['umfang']->__toString();

            // immos
            foreach ($xml->anbieter->immobilie as $immo)
            {
                $imdata = new Immobilie();

                //echo "\n";
                //echo "----------------------------------------------------------------------" . "\n";

                //$hashcode = md5($immo->asXML());
                $imdata->hashcode = md5($immo->asXML());

                //$action = $immo->verwaltung_techn->aktion['aktionart'];
                //echo "$action\n";
                $imdata->action = $immo->verwaltung_techn->aktion['aktionart']->__toString();

                //$objektnr = $immo->verwaltung_techn->objektnr_extern;
                //echo "$objektnr\n";
                //$imdata->objektnr = $immo->verwaltung_techn->objektnr_extern;
                //$imdata->objektnr = trim(preg_replace('/\s+/', ' ', preg_replace('/[\n\r]/', ' ', $immo->verwaltung_techn->objektnr_extern)));
                $imdata->objektnr = trim(preg_replace('/[\n\r]/', ' ', $immo->verwaltung_techn->objektnr_extern));

                $nutzungsart = '';
                foreach ($immo->objektkategorie->nutzungsart->attributes() as $a => $v) {
                    if ($v == "true" || $v == "1") {
                        $nutzungsart = $a;
                    }
                }
                //echo "$nutzungsart\n";
                $imdata->nutzungsart = $nutzungsart;

                $vermarktungsart = '';
                foreach ($immo->objektkategorie->vermarktungsart->attributes() as $a => $v) {
                    if ($v == "true" || $v == "1") {
                        $vermarktungsart = $a;
                    }
                }
                //echo "$vermarktungsart\n";
                $imdata->vermarktungsart = $vermarktungsart;

                //$imdata->geo['plz'] = isset($immo->geo->plz) ? $immo->geo->plz->__toString() : '-';
                //$imdata->geo['breitengrad'] = isset($immo->geo->geokoordinaten['breitengrad']) ? $immo->geo->geokoordinaten['breitengrad']->__toString() : '-';
                //$imdata->geo['laengengrad'] = isset($immo->geo->geokoordinaten['laengengrad']) ? $immo->geo->geokoordinaten['laengengrad']->__toString() : '-';
                $imdata->geo['ort'] = isset($immo->geo->ort) ? $immo->geo->ort->__toString() : '-';
                //$imdata->geo['strasse'] = isset($immo->geo->strasse) ? $immo->geo->strasse->__toString() : '-';
                //$imdata->geo['hausnummer'] = isset($immo->geo->hausnummer) ? $immo->geo->hausnummer->__toString() : '-';
                //$imdata->geo['bundesland'] = isset($immo->geo->bundesland) ? $immo->geo->bundesland->__toString() : '-';
                //$imdata->geo['iso_land'] = isset($immo->geo->land['iso_land']) ? $immo->geo->land['iso_land']->__toString() : '-';


                //echo "kontaktperson ---\n";
                //$kontaktperson = $immo->kontaktperson->vorname;
                //echo "$kontaktperson\n";
                $imdata->kontaktperson = $immo->kontaktperson->vorname->__toString();

                //echo $immo->kontaktperson->email_zentrale . "\n";
                //var_dump($immobilie->kontaktperson->name2);
                // foreach ($immo->kontaktperson->children() as $child) {
                //     if ($child->getName() == "land") {
                //         echo $child->getName() . ":" . $child["iso_land"] . "\n";
                //     } else {
                //         echo $child->getName() . ": " . $child . "\n"; //->__toString()."\n";
                //     }
                // }

                //$imdata->anhang = isset($immo->anhaenge->anhang[0]) ? $immo->anhaenge->anhang[0]->daten->pfad : 'xxx';

                if(isset($immo->anhaenge->anhang)){
                    foreach ($immo->anhaenge->anhang as $anhang){
                        $imdata->anhang[] = $anhang->daten->pfad->__toString();
                    }
                }
                
                $data->immobilien[] = $imdata;
            }

        }

        return $data;
    }
}

