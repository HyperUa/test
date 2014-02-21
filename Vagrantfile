# -*- mode: ruby -*-
# vi: set ft=ruby :

# Vagrantfile API/syntax version. Don't touch unless you know what you're doing!
VAGRANTFILE_API_VERSION = "2"

Vagrant.configure(VAGRANTFILE_API_VERSION) do |config|

  config.vm.box = "precise32"
	
  external_ports = {http: 80, https: 443}

  config.vm.network :forwarded_port, guest: 80, host:8080
  config.vm.network :forwarded_port, guest: 443, host:8443
  config.vm.network :forwarded_port, guest: 3306, host:3307

  config.vm.synced_folder "./", "/home/myproj/webapp", owner: "myproj", group: "www-data"
  config.vm.synced_folder "../vendor", "/home/myproj/vendor", owner: "myproj", group: "www-data"

end
