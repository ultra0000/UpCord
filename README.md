# UpCord
UpCord is meant to be a file sharing service that you can host yourself for you and your friends. It uses Discord as authentication. It's meant to run on Apache.

[https://discord.com/developers/applications](Create an app here first.)

# config.json
* owner - Owner of the instance, it's displayed in the home page. You can leave this as "unspecified" if you don't want to show that.
* size_limit - File size limit in bytes. Default is 50000000
* login_info - Information used to authenticate with Discord.
* * url - URL you get from the OAuth2 URL Generator
* * client_id - Your app's client ID. It's under the "OAuth2" tab.
* * client_secret - Your app's client secret. It's under the "OAuth2" tab.
* * redirect_uri - The URI you specify under the "OAuth2" tab.

# whitelist.json
This is a whitelist that determines who can access your instance. An example is included.