Mandagreen FriendlyLog
========================
FriendlyLog adds a unified abstraction layer for logging messages to the database.

### Download & Install
**Using modman**: modman clone https://github.com/firewizard/FriendlyLog.git

**Manually**: Clone the repository or [:arrow_down: download the archive](https://github.com/firewizard/FriendlyLog/archive/master.zip) and copy the `app` folder in your Magento root directory.


### Usage
There are a few things to add to your own code in order to use this.
1. First, in your module's config.xml, add a new node:
```
<friendlylog>
	<groups>
		<my_module_namespace>My module's friendly name</my_module_namespace>
	</groups>
</friendlylog>
```

This will add the above name as a filter in the admin grid.

2. Then, create a new model that extends `Mandagreen_FriendlyLog_Model_Log_Abstract`:
```
class My_Module_Model_Logger_Friendly extends Mandagreen_FriendlyLog_Model_Log_Abstract
{
    protected function _construct()
    {
        $this->_friendlyLogger->setGroupName('my_module_namespace');
    }
}
```

This will set the group_name for all messages logged by this module.

3. Start using it:
```
Mage::getSingleton('my_module_namespace/logger_friendly')->log($message);
```

You need to use the logger as a singleton if you wish to save a single entry per request cycle. If you want to save each log entry separately, use it as a modle and make sure the object gets destroyed (or commit the data yourself). 

The logger works as queue: all messages are put in a queue and saved automatically when the object is destructed - usually at the end of the request cycle.

Each log entry also has a subject, which can be set explicitly or implicitly (the first entry in the queue).

*Tip:* Usually this should be used inside a `log` method, that checks the log level of the messages and decides whether or not to save to file, to db or both. 


### Configuration/setup
There's nothing much to set up, except for the clean up threshold, in days. You can find this under 
Go to System > Configuration > Developer > Friendly Log



### Contributing/Bug reports
All contributions, bug reports and PRs are highly appreciated.