VAGRANTFILE_API_VERSION = "2"

Vagrant.configure(VAGRANTFILE_API_VERSION) do |config|
  config.vm.define "web" do |web|
    web.vm.box = "bento/ubuntu-16.04"
    web.vm.network :private_network, ip: "192.168.33.42"
    web.vm.network :forwarded_port, guest: 80, host: 8080
    web.ssh.insert_key = false

    # Disable default synced folder.
    web.vm.synced_folder ".", "/vagrant", disabled: false

    # Sync working folder for website.
    #web.vm.synced_folder "./vagrant", "/vagrant", create: true

    web.vm.provider :virtualbox do |v|
      v.name = "news.dev"
      v.memory = 512
      v.cpus = 1
      v.customize ["modifyvm", :id, "--natdnshostresolver1", "on"]
      v.customize ["modifyvm", :id, "--ioapic", "on"]
      v.customize ["modifyvm", :id, "--cableconnected1", "on"]
    end

    # Enable provisioning with Ansible.
    web.vm.provision "ansible" do |ansible|
      ansible.limit = "all"
      ansible.playbook = "ansible/site.yml"
    end
  end
end
