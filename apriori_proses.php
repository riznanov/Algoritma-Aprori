<?php
include 'header.php';
include 'config.php';
include 'apriori.php'; //evaluasi program pada apriori.php

$file='dataset/maret2.txt'; //parameter baru untuk memanggil file di folder dataset
$total_transaksi=count(file($file));//parameter utk menghitung jml transaksi
$minsup=(($_POST['minsup']/100)*$total_transaksi)+1;
$minconf=$_POST['minconf'];

	$wangi=new Apriori();
	$wangi->setSumTrans($total_transaksi);
	$wangi->setMaxScan(20);
		$wangi->setMinSup(round($minsup));
		$wangi->setMinConf($minconf);
		$wangi->setDelimiter(',');
		$wangi->process($file);
	
	echo "<p align='center' class='warning''>Total Transaksi: ".$wangi->getSumTrans()."<br/>
	Minimum Support : ".$_POST['minsup']."%<br/>
	Minimum Confidence : ".$minconf."%</p><hr/>";
	
	echo '<h3>Frequent Itemsets</h3>';
		$wangi->printFreqItemsets();
		$wangi->printAssociationRules();
		$wangi->saveAssociationRules('output/associationRules.txt');
			
	

?>
		
