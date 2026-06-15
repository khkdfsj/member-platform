<?php
require_once __DIR__.'/../lib/bootstrap.php';
function u_seed($s){return json_decode('"'.$s.'"');}
$pdo=db();$now=now();
$templates=[
 [u_seed('\\u6210\\u5458\\u5165\\u90e8\\u5ba1\\u6279'),'member_onboarding',u_seed('\\u4ece\\u62a5\\u540d\\u3001\\u90e8\\u95e8\\u521d\\u5ba1\\u5230\\u7ba1\\u7406\\u5458\\u5f52\\u6863\\u7684\\u6807\\u51c6\\u6d41\\u7a0b')],
 [u_seed('\\u5c97\\u4f4d\\u8c03\\u6574\\u5ba1\\u6279'),'position_change',u_seed('\\u6210\\u5458\\u8de8\\u90e8\\u95e8\\u6216\\u5c97\\u4f4d\\u53d8\\u66f4\\u6d41\\u7a0b')],
 [u_seed('\\u505c\\u804c\\u9000\\u4f11\\u5904\\u7406'),'status_change',u_seed('\\u654f\\u611f\\u72b6\\u6001\\u53d8\\u66f4\\u5fc5\\u987b\\u7559\\u75d5\\u5ba1\\u6279')]
];
foreach($templates as $t){$pdo->prepare('INSERT INTO workflow_templates(name,category,description,is_active,created_by,created_at,updated_at) SELECT ?,?,?,?,?,?,? FROM DUAL WHERE NOT EXISTS (SELECT 1 FROM workflow_templates WHERE category=?)')->execute([$t[0],$t[1],$t[2],1,'system',$now,$now,$t[1]]);} 
$metricRows=[[u_seed('\\u5de5\\u4f5c\\u8d28\\u91cf'),'work_quality','performance',0.30],[u_seed('\\u54cd\\u5e94\\u6548\\u7387'),'response_efficiency','performance',0.20],[u_seed('\\u534f\\u4f5c\\u8d21\\u732e'),'collaboration','culture',0.20],[u_seed('\\u6210\\u957f\\u6c89\\u6dc0'),'growth','growth',0.15],[u_seed('\\u7eaa\\u5f8b\\u53ef\\u9760'),'discipline','risk',0.15]];
foreach($metricRows as $m){$pdo->prepare('INSERT INTO kpi_metrics(name,metric_key,dimension,weight,max_score,is_active,created_at) VALUES(?,?,?,?,100,1,?) ON DUPLICATE KEY UPDATE name=VALUES(name),dimension=VALUES(dimension),weight=VALUES(weight)')->execute([$m[0],$m[1],$m[2],$m[3],$now]);}
echo "Seeded workflow and KPI catalog.\n";
