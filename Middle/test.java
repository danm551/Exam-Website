public class test{ 
  public static void main (String[] args){ 
    int num = 8;
    int test = forLoop(num);
    System.out.println(test);
  }
  
public static int forLoop(int num){
   int result = 0;
   for(int i = 0; i <= num; i++){
     result += i;
   }
  return result;
}
}