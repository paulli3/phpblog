<?php
class parsetxtCommand extends CConsoleCommand
{
	public function run($args)
	{
		StatisticsServer::parseTxT();		
	}
}