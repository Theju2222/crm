<?php
include 'init.php';
if(!empty($_POST['action']) && $_POST['action'] == 'auth') {
	$users->login();
}
if(!empty($_POST['action']) && $_POST['action'] == 'listTicket') {
	$tickets->showTickets();
}
if(!empty($_POST['action']) && $_POST['action'] == 'listTicket1') {
	$tickets->showTickets1();
}
if(!empty($_POST['action']) && $_POST['action'] == 'listTicket2') {
	$tickets->showTickets2();
}
if(!empty($_POST['action']) && $_POST['action'] == 'listTicket3') {
	$tickets->showTickets3();
}
if(!empty($_POST['action']) && $_POST['action'] == 'listTicket4') {
	$tickets->showTickets4();
}
if(!empty($_POST['action']) && $_POST['action'] == 'listTicket5') {
	$tickets->showTickets5();
}
if(!empty($_POST['action']) && $_POST['action'] == 'listTicket6') {
	$tickets->showTickets6();
}
if(!empty($_POST['action']) && $_POST['action'] == 'createTicket') {
	$tickets->createTicket();
}
if(!empty($_POST['action']) && $_POST['action'] == 'getTicketDetails') {
	$tickets->getTicketDetails();
}
if(!empty($_POST['action']) && $_POST['action'] == 'updateTicket') {
	$tickets->updateTicket();
}
if(!empty($_POST['action']) && $_POST['action'] == 'closeTicket') {
	$tickets->closeTicket();
}
if(!empty($_POST['action']) && $_POST['action'] == 'reopenTicket') {
    $tickets->reopenTicket();
}
if(!empty($_POST['action']) && $_POST['action'] == 'saveTicketReplies') {
	$tickets->saveTicketReplies();
}
if(!empty($_POST['action']) && $_POST['action'] == 'saveTicketReplies1') {
	$tickets->saveTicketReplies1();
}
if(!empty($_POST['action']) && $_POST['action'] == 'saveTicketReplies2') {
	$tickets->saveTicketReplies2();
}
if(!empty($_POST['action']) && $_POST['action'] == 'saveTicketReplies3') {
	$tickets->saveTicketReplies3();
}
?>