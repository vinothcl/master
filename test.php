<?php
class Linkedin {

	public function openConnection()
	{
		$credentials = [];
	    $credentials['client_id'] = '86j3v7y1fsropa';
	    $credentials['client_secret'] = 'tm7OcILTgW7iniV6';
	    $credentials['redirect'] = 'https://www.laraphp.com/';

	    try
	    {

	        $this->connection = new \LinkedIn\LinkedIn([
	            'api_key' => $credentials['client_id'],
	            'api_secret' => $credentials['client_secret'],
	            'callback_url' => $credentials['redirect'],
	        ]);

	        $this->connection->setAccessToken(\Auth::user()->linkedin->token['access_token']);
	    }
	    catch (\Exception $e)
	    {
	        \Log::error('Failed LinkedIn auth, exception is attached', [$e]);

	        throw new CouldNotPostException('Please, re-link your LinkedIn account, failed to send your post to LinkedIn.');
	    }
	}

	public function send()
	{
	     

	    try
	    {
	    	echo 1234;exit;
	        $result = $this->connection->post('/people/~/shares?format=json', $object);

	        $this->posted($result['updateKey']);
	    }
	    catch (\Exception $e)
	    {
	        \Log::error('Failed LinkedIn posting, exception is attached', [$e]);

	        throw new CouldNotPostException('Failed to send your post to LinkedIn, our developers have been notified of this error.');
	    }
	}
}

return (new Linkedin)->send();
?>