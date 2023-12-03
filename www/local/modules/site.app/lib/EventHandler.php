<?

namespace Site\App;

class EventHandler
{

	public static function onPageStart()
	{
	}

	public static function OnEpilog()
	{
		Debug::showLog();
	}
}
