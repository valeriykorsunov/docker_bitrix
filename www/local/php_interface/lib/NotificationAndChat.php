<?

use Bitrix\Main\Diag\Debug;

class NotificationAndChat
{

	private $value = null;
	private $loop = null;
	private $port = 5004;
	private $dnode = null;

	public function __construct()
	{
		$this->loop = new React\EventLoop\StreamSelectLoop();

		$this->dnode = new DNode\DNode($this->loop, $this);
	}

	public function sentNotification($message, $idUser)
	{
		if(!$this->socketTest()) return false;
		$this->dnode->connect($this->port, function ($remote, $connection) use ($message, $idUser)
		{
			/* Get property value from the server */
			$remote->transform($message, $idUser, function ($result) use ($connection)
			{
				/* Close the connection */
				$this->value = $result;
				$connection->end();
			});
		});
		$this->loop->run();
		return $this->value;
	}
	private function socketTest()
	{
		$handle = fsockopen('localhost', 3001);
		if ($handle !== false)
		{
			fclose($handle);
		 	return true;
		}
		else
		{
			fclose($handle);
			return false;
		}
	}
}