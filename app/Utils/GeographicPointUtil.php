<?php

namespace App\Utils;


use PHPCoord\GeographicPoint;
use PHPCoord\UnitOfMeasure\Angle\Degree;
use PHPCoord\CoordinateReferenceSystem\Geographic2D;
use PHPCoord\CoordinateReferenceSystem\Projected;
use PHPCoord\ProjectedPoint;
use PHPCoord\UTMPoint;
use PHPCoord\UnitOfMeasure\Length\Metre;


class GeographicPointUtil
{
    public static function createUTMPoint($x_axis,$y_axis)
    {
        // 24.444732211797746, 39.592818018072094
        $result=[]; 
        $point = "";
        if($x_axis && $y_axis){
            $from = GeographicPoint::create(
                Geographic2D::fromSRID(Geographic2D::EPSG_WGS_84_G2139),//Geographic2D::EPSG_WGS_84
                new Degree($x_axis),
                new Degree($y_axis),
                null
            );
            $point = $from->asUTMPoint();
            $result['utm_easting'] = $point->getEasting(); // Metre 560617.62835156
            $result['utm_northing']  = $point->getNorthing(); // Metre 2703445.3692933
            $result['zone'] = $point->getZone(); // int 37
            $result['hemisphere'] = $point->getHemisphere(); //"N"
            // dd($result);
        }
        return collect($result);
    }

    public static function createXYPoint($easting,$northing)
    {
        // 560617.62835156, 2703445.3692933
        $result=['lat'=>0,'lng'=>0];
        $zone = 37;
        if($easting && $northing){
            try {
// dd("asfdas");
                $from = ProjectedPoint::createFromEastingNorthing(
                    Projected::fromSRID(Projected::EPSG_WGS_84_UTM_ZONE_37N),
                    
                    new Metre($easting),
                    new Metre($northing)
                );
                $toCRS = Geographic2D::fromSRID(Geographic2D::EPSG_WGS_84_G2139);//Geographic2D::EPSG_WGS_84
                $to = $from->convert($toCRS); // $to instanceof GeographicPoint


                // $from = new UTMPoint(
                //     new Metre($easting),
                //     new Metre($northing),
                //     17,
                //     UTMPoint::HEMISPHERE_NORTH,
                //     Geographic2D::fromSRID(Geographic2D::EPSG_WGS_84)
                // );
                // $to = $from->asGeographicPoint();

                /*$from = new UTMPoint(
                    Projected::fromSRID(Projected::EPSG_KSA_GRF17_UTM_ZONE_36N),
                    new Metre($northing),
                    new Metre($easting)
                );

                $toCRS = Geographic2D::fromSRID(Geographic2D::EPSG_WGS_84);
                $to = $from->convert($toCRS); // $to instanceof GeographicPoint*/


                    
                $point = explode(",",str_replace(array("(",")"),array("",""),(string) $to));

                $result['status'] = "ok";
                $result['easting'] = $easting;
                $result['northing'] = $northing;
                $result['lat'] = (double) trim($point[0]); // $result['lat'] = $to->getLatitude();
                $result['lng'] = (double) trim($point[1]); // $result['lng'] = $to->getLongitude();
                
                $result['latitude'] = $result['lat'];
                $result['longitude'] = $result['lng'];
                // dd($to);
                // dd($result);
            }catch (\Exception $e){

            }
        }
        return collect($result);
    }
}
