<?php
namespace App\Listeners;
class ClearSessionAfterUserLogout 
{
	public function handle(Logout $event)
	{
		Session::flush();
	}
}

?>