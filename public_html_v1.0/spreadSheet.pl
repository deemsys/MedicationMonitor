#!/usr/bin/perl

use strict;
use CGI qw(:cgi);
use Data::Dumper;
use DBI;
use Spreadsheet::WriteExcel;


my $q = CGI->new();

#print $q->header();

my $patientId = $q->param('id');
my $assesQuestId = $q->param('type');
my $qDate = (defined $q->param('dat') && $q->param('dat')) ? $q->param('dat') : "";

my $host = 'localhost';
my $db='medsmoni_medicationmonitor';
my $pwd='root';
my $user='root';
my $DBH =   DBI->connect("dbi:mysql:$db:$host", "$user", "$pwd");
if(!$DBH){ print "Error Connecting to the database: $DBI::errstr\n"; }

my $where="";
if ($qDate)
{
	$where = " AND vd_viewass_date = '".$qDate."'"
}

my $query = $DBH->prepare("SELECT vd_viewass_date, vd_viewass_question, vd_viewass_answer, vd_viewass_patientnotes FROM tbl_viewassessment_details WHERE vd_viewass_assessmentid = '".$assesQuestId."' AND vd_viewass_patientid = '".$patientId."'".$where);
$query->execute();
my $excelData={};
my $i=0;
my $tmpDate='';
while (my ($datetime, $quest, $ans, $notes) = $query->fetchrow_array) 
{
	my $newDateTime = $datetime;
	$newDateTime =~ s/(\-|\:|\s+)//g;
	if ($tmpDate && $tmpDate!=$newDateTime)
	{
		$i=0;
	}
	$tmpDate = $newDateTime;

	$$excelData{$newDateTime}{$i}{'date'} =  $datetime;
	$$excelData{$newDateTime}{$i}{'quest'} =  $quest;
	$$excelData{$newDateTime}{$i}{'ans'} =  $ans;
	$$excelData{$newDateTime}{$i}{'notes'} =  $notes;
	$i++;
}

my $outputFile  = '/code/public_html_v1.0/spreadSheet.xls';
my $excelFile   = Spreadsheet::WriteExcel->new($outputFile);
my $worksheet   = $excelFile->add_worksheet();
my $row         = 2;
my $titleFormat = $excelFile->add_format();
$titleFormat->set_bold();
$titleFormat->set_center_across();

my $smallFont = $excelFile->add_format( font => 'Arial', size => 10 );

my $boldFont = $excelFile->add_format( font => 'Arial', size => 10 );
$boldFont->set_bold();

$worksheet->write( 0, 0, 'Question', $boldFont );
$worksheet->set_column( 0, 0, 80);
$worksheet->write( 0, 1, 'Answer', $boldFont );
$worksheet->set_column( 1, 1, 10 );
$worksheet->write( 0, 2, 'Patient Notes', $boldFont );
$worksheet->set_column( 2, 2, 20 );
my $format = $excelFile->add_format( border  => 0, valign  => 'vcenter', font => 'Arial', size => 10);
$format->set_bold();

my @sortKeys = sort {$excelData->{$a} <=> $excelData->{$b}} keys %$excelData;

foreach my $datetime (@sortKeys)
{
	my $newHash = $excelData->{$datetime};
	$worksheet->merge_range( $row, 0, $row, 2, $newHash->{0}{'date'}, $format);
	$row++;
	foreach my $key (sort keys %$newHash)
	{
    		$worksheet->write( $row, 0, $newHash->{$key}{'quest'}, $smallFont);
    		$worksheet->write( $row, 1, $newHash->{$key}{'ans'}, $smallFont);
		$worksheet->write( $row++, 2, $newHash->{$key}{'notes'}, $smallFont);
			
	}
	$row++;
}
$excelFile->close();

my $url = "http://localhost/code/public_html_v1.0/spreadSheet.xls";

print "Location: $url\n\n";