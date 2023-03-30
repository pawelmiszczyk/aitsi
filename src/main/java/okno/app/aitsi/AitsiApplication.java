package okno.app.aitsi;

import okno.app.aitsi.model.User;
import okno.app.aitsi.repository.UserRepository;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.boot.CommandLineRunner;
import org.springframework.boot.SpringApplication;
import org.springframework.boot.autoconfigure.SpringBootApplication;

@SpringBootApplication
public class AitsiApplication implements CommandLineRunner {

	public static void main(String[] args) {
		SpringApplication.run(AitsiApplication.class, args);
	}

	@Autowired
	private UserRepository userRepository;

	@Override
	public void run(String...args) throws Exception {
		this.userRepository.save(new User("Ramesh", "Fadatare", "ramesh@gmail.com"));
		this.userRepository.save(new User("Tom", "Cruise", "tom@gmail.com"));
		this.userRepository.save(new User("Tony", "Stark", "tony@gmail.com"));
	}
}
