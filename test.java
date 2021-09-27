import java.util.Scanner;

public class test {
	public void main(String args) {
		Scanner scan = new Scanner(System.in);
		System.out.println("Text here:");
		String text = scan.next();
		
		text = text.replaceAll(" ","");
		System.out.println("___" + text);
	}
}
