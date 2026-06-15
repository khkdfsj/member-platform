<?php
function env_load($path){$out=[];foreach(@file($path,FILE_IGNORE_NEW_LINES|FILE_SKIP_EMPTY_LINES)?:[] as $line){if($line[0]==='#'||strpos($line,'=')===false)continue;[$k,$v]=explode('=',$line,2);$out[trim($k)]=trim($v);}return $out;}
$ENV=env_load(__DIR__.'/../.env');function envv($k,$d=null){global $ENV;return $ENV[$k]??$d;}function db(){static $pdo;if(!$pdo){$pdo=new PDO('mysql:host='.envv('DB_HOST','127.0.0.1').';dbname='.envv('DB_NAME').';charset=utf8mb4',envv('DB_USER'),envv('DB_PASS'),[PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION,PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_ASSOC]);}return $pdo;}function json_out($data,$code=200){http_response_code($code);header('Content-Type: application/json; charset=utf-8');echo json_encode($data,JSON_UNESCAPED_UNICODE);exit;}function body(){$raw=file_get_contents('php://input');$j=json_decode($raw,true);return is_array($j)?$j:$_POST;}function now(){return date('Y-m-d H:i:s');}
require_once __DIR__.'/../../auth-monitor/sdk/php/AuthMonitorClient.php';function auth_client(){return new AuthMonitorClient(['app_id'=>envv('AUTH_MONITOR_APP_ID'),'app_secret'=>envv('AUTH_MONITOR_APP_SECRET'),'api_base'=>envv('AUTH_MONITOR_API')]);}function audit($actor,$action,$targetType=null,$targetId=null,$detail=null){db()->prepare('INSERT INTO audit_logs(actor,action,target_type,target_id,detail,ip,created_at) VALUES(?,?,?,?,?,?,?)')->execute([$actor,$action,$targetType,$targetId,$detail,$_SERVER['REMOTE_ADDR']??'',now()]);}
function parse_member_import_file($path){
    $ext=strtolower(pathinfo($path, PATHINFO_EXTENSION));
    $rows=[];
    if(in_array($ext,['xls','xlsx']) && file_exists('/var/www/html/public/PHPExcel/Classes/PHPExcel.php')){
        require_once '/var/www/html/public/PHPExcel/Classes/PHPExcel.php';
        require_once '/var/www/html/public/PHPExcel/Classes/PHPExcel/IOFactory.php';
        $type=PHPExcel_IOFactory::identify($path);
        $reader=PHPExcel_IOFactory::createReader($type);
        $excel=$reader->load($path);
        $sheet=$excel->getSheet(0);
        $highestRow=$sheet->getHighestRow();
        for($i=1;$i<=$highestRow;$i++){
            $rows[]=[
                trim((string)$sheet->getCell('A'.$i)->getValue()),
                trim((string)$sheet->getCell('B'.$i)->getValue()),
                trim((string)$sheet->getCell('C'.$i)->getValue()),
                trim((string)$sheet->getCell('D'.$i)->getValue()),
            ];
        }
        return $rows;
    }
    if(($h=fopen($path,'r'))){while(($r=fgetcsv($h))!==false)$rows[]=$r;fclose($h);}return $rows;
}
