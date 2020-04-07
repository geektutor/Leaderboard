import java.awt.BorderLayout;
import java.awt.Color;
import java.awt.Font;
import java.awt.GridLayout;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.util.Random;

import javax.swing.JButton;
import javax.swing.JFrame;
import javax.swing.JLabel;
import javax.swing.JMenu;
import javax.swing.JMenuBar;
import javax.swing.JMenuItem;
import javax.swing.JOptionPane;
import javax.swing.JPanel;
import javax.swing.JTextField;

public class Sudoku {
    	private JFrame frame;
	private JPanel panel1;
	//private ImagePanel panel2;
	private JPanel panel2;
	private JPanel mainpanel;
	private JButton generator,solver;
	private JButton beg,mod,adv,but;
	private JLabel label1,label2,label3;
	private JLabel[][] slabel=new JLabel[9][9];
	private JTextField[] tbox=new JTextField[81];
	private GridLayout layout;
	private Font font1;
	private byte[][] ip=new byte[9][9];
	private byte[][] gip=new byte[9][9];
	private byte[][] a=new byte[82][3];
	private byte difficulty;
	private byte gap=5;
	private int r,c,val;
	private byte count;
	private boolean SOLVER,VALIDITY;
	public static void main(String args[])
	{
		new SudokuSG();
	}
}

class SudokuSG 
{
	public SudokuSG()
	{
		Sframe();
		Smenu();
	}
	
	void Sframe()
	{
		frame= new JFrame("geeks SUDOKU!");
		frame.setSize(530,530);
		frame.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
		frame.setVisible(true);
		frame.setResizable(false);
		font1 = new Font("Comic Sans MS",Font.CENTER_BASELINE,40);
		label1=new JLabel("        ");
		label2=new JLabel("        ");
		label3=new JLabel("      ");
		but=new JButton("Get answers");
		mainpanel=new JPanel();
		mainpanel.setBackground(Color.WHITE);
		mainpanel.setLayout(new BorderLayout());
		panel1=new JPanel();
		panel1.setBackground(Color.orange);
		panel1.setLayout(null);
		generator=new JButton("Generator");
		solver=new JButton("Solver");
		solver.addActionListener(new ActionListener()
		{
			public void actionPerformed(ActionEvent e)
			{
				SOLVER=true;
				init();
				sudokuBox();
				ip4solver();
			}
		}
		);
		generator.addActionListener(new ActionListener()
		{
			public void actionPerformed(ActionEvent e)
			{
				SOLVER=false;
				sudokuBox();
				init();
				genFrame();
			}
		}
		);
		but.addActionListener(new ActionListener()
		{
			public void actionPerformed(ActionEvent e)
			{		
				if(SOLVER)
				{
					VALIDITY=getInput();
					if(VALIDITY)
					{
						boolean CHECK=check();
						if(CHECK==false)
						{
								JOptionPane.showMessageDialog(null,"Entered Sudoku problem is not valid");
								CHECK=true;
						}
						solve();
						answer();
					}
				}
				else
				{
					//solve();
					answer();
				}
			}
		}
		);
		generator.setBounds(150,210,100,30);
		solver.setBounds(270,210,100,30);
		panel1.add(generator);
		panel1.add(solver);
		mainpanel.add(panel1,BorderLayout.CENTER);
		frame.add(mainpanel);
	}
	
	void sudokuBox()
	{
		mainpanel.removeAll();
		mainpanel.updateUI();
		//panel2 = new ImagePanel(new ImageIcon("sudoku.png").getImage());
		panel2=new JPanel();
		layout = new GridLayout(9,9);
		layout.setVgap(gap);
		layout.setHgap(gap);
		panel2.setLayout(layout);
		panel2.setBackground(Color.WHITE);
		mainpanel.add(panel2,BorderLayout.CENTER);
		mainpanel.add(label1,BorderLayout.PAGE_START);
		mainpanel.add(label2,BorderLayout.LINE_END);
		mainpanel.add(label3,BorderLayout.LINE_START);
		mainpanel.add(but,BorderLayout.PAGE_END);
	}
	
	void ip4solver(){
		for(int i=0;i<81;i++)
		{
		    	tbox[i]=new JTextField("");
		    	tbox[i].setFont(font1);
				panel2.add(tbox[i]);
				
		}
		panel2.updateUI();
	}
	
	void answer()
	{
		panel2.removeAll();
		for(int i=0;i<9;i++)
		{
			for(int j=0;j<9;j++)
			{
				slabel[i][j]=new JLabel(""+ip[i][j]);
				slabel[i][j].setForeground(Color.BLACK);
				slabel[i][j].setFont(font1);
				panel2.add(slabel[i][j]);
					
			}
		}
		panel2.updateUI();
	}
	
	void init()
	{
		for(int i=0;i<82;i++)
		 {
		   a[i][0]=10;
		   a[i][1]=10;
		   a[i][2]=1;
		 }
		for(byte i=0;i<9;i++)
		{
			for(byte j=0;j<9;j++)
			{
				ip[i][j]=0;
			}
		}
		
	}
	
	boolean getInput()
	{
		for(byte i=0;i<81;i++)
		{
			String temp=tbox[i].getText();
			if(temp.length()<=1 &&( temp.equals("0")||  temp.equals("1")|| temp.equals("2")|| temp.equals("3")|| temp.equals("4")|| temp.equals("5")|| temp.equals("6")|| temp.equals("7")|| temp.equals("8")|| temp.equals("9")))
			{
				ip[i/9][i%9]=Byte.parseByte(temp);
			}
			else if(temp.equals("")|| temp.equals(" "))
			{
				ip[i/9][i%9]=0;
			}
			else 
			{
				JOptionPane.showMessageDialog(null,"Entered Sudoku problem is not valid");
				tbox[i].setText("");
				return false;
			}
		}
		return true;
	}
	
	boolean check()
	{
		byte c=0;
		for(int i=0;i<9;i++)
		{
			for(int j=0;j<9;j++)
			{
				if(ip[i][j]>9){
				return false;
				}
			}
		}
		for(int i=0;i<9;i++)
		{
			for(int j=0;j<9;j++)
			{
				if(ip[i][j]!=0)
				{
					c=0;
					for(int k=0;k<9;k++)
					{
						if(ip[i][k]==ip[i][j] && j!=k )
							return false;
						if(ip[k][j]==ip[i][j] && i!=k)
							return false;
						if(ip[(i/3)*3+(k/3)][(j/3)*3+(k%3)]==ip[i][j])
						{
							c++;
							if(c>1){
							return false;
							}
						}
					}
				}
			}
		}
		return true;
	}
	
	//solve the given sudoku problem
	void solve()
	{
		 byte i,j,k,count=0;
		 for(i=0;i<9;i++)
		 {
		  for(j=0;j<9;j++)
		  {
		   if(ip[i][j]==0)
		   {
		    a[count][0]=i;
		    a[count][1]=j;
		    count++;
		   }
		  }
		 }
		 count=0;
		 while(a[count][0]!=10)
		 {
		  i=a[count][0];
		  j=a[count][1];
		  for(k=0;k<9;k++)
		  {
		   if(a[count][2]>9)
		   {
		    a[count][2]=1;
		    ip[i][j]=0;
		    count--;
		    break;
		   }
		   if(a[count][2]==ip[i][k])
		   {
		    a[count][2]++;
		    break;
		   }
		   else if(a[count][2]==ip[k][j])
		   {
		    a[count][2]++;
		    break;
		   }
		   else if(a[count][2]==ip[((i/3)*3)+(k/3)][((j/3)*3)+(k%3)])
		   {
		    a[count][2]++;
		    break;
		   }
		   if(k==8)
		   {
		    ip[i][j]=a[count][2];
		    count++;
		    a[count][2]=1;
		   }
		  }
		 }
	}
	
	void genFrame()
	{
		difficulty=0;
		mainpanel.removeAll();
		mainpanel.updateUI();
		panel1=new JPanel();
		panel1.setBackground(Color.ORANGE);
		beg=new JButton("Beginner");
		mod=new JButton("Moderate");
		adv=new JButton("Advanced");
		panel1.setLayout(null);
		beg.setBounds(220,140,100,30);
		mod.setBounds(220,190,100,30);
		adv.setBounds(220,240,100,30);
		beg.addActionListener(new ActionListener()
		{
			public void actionPerformed(ActionEvent e)
			{
				difficulty=3;
				sudokuBox();
				generate();
			}
		});
		mod.addActionListener(new ActionListener()
		{
			public void actionPerformed(ActionEvent e)
			{
				difficulty=5;
				sudokuBox();
				generate();
			}
		});
		adv.addActionListener(new ActionListener()
		{
			public void actionPerformed(ActionEvent e)
			{
				difficulty=6;
				sudokuBox();
				generate();
			}
		});
		panel1.add(beg);
		panel1.add(mod);
		panel1.add(adv);
		mainpanel.add(panel1);
	}
	void generate()
	{
		for(byte i=0;i<9;i++)
		{
			for(byte j=0;j<9;j++)
			ip[i][j]=0;
		}
		for(int i=0;i<82;i++)
		{
		   a[i][0]=10;
		   a[i][1]=10;
		   a[i][2]=1;
		}
		count=0;
		Random random = new Random();
		while(count<10)
		{
			r=random.nextInt(9);
			c=random.nextInt(9);
			val=random.nextInt(10);
			if(ip[r][c]==0 && val!=0)
			{
				ip[r][c]=(byte)val;
				boolean check=check();
				if(check==false){
				ip[r][c]=0;
				}
				else
				count++;
			}
		}
		solve();
		for(byte i=0;i<9;i++)
		{
			for(byte j=0;j<9;j++)
			{
				gip[i][j]=ip[i][j];
			}
		}
		count=(byte) (difficulty*5);
		while(count>0)
		{
			r=random.nextInt(9);
			c=random.nextInt(9);
			if(gip[r][c]!=0)
			{
				gip[r][c]=0;
				count--;
			}
		}
		ip4generator();
	}
	
	void ip4generator()
	{
		for(int i=0;i<81;i++)
		{
				if(gip[i/9][i%9]==0)
				{
					tbox[i]=new JTextField("");
					tbox[i].setFont(font1);
					panel2.add(tbox[i]);
				}
				else
				{
					slabel[i/9][i%9]=new JLabel(""+gip[i/9][i%9]);
					slabel[i/9][i%9].setForeground(Color.BLACK);
					slabel[i/9][i%9].setFont(font1);
					panel2.add(slabel[i/9][i%9]);
				}
		}
		panel2.updateUI();
	}
	
	void Smenu()
	{
		  JMenuBar menu = new JMenuBar();
		  JMenu file = new JMenu("File");
		  JMenuItem exit = new JMenuItem("Exit");
		  JMenuItem main = new JMenuItem("Main Menu");
		  main.addActionListener(new ActionListener()
		  {
		   public void actionPerformed(ActionEvent e)
		   {
		    frame.removeAll();
		    Sframe();
		    Smenu();
		   }
		  });
		  exit.addActionListener(new ActionListener()
		  {
		   public void actionPerformed(ActionEvent e)
		   {
		    System.exit(0);
		   }
		  });
		  file.add(main);
		  file.add(exit);
		  menu.add(file);
		  
		  JMenu help = new JMenu("Help");
		  JMenuItem about = new JMenuItem("About");
		  about.addActionListener(new ActionListener()
		  {
		   public void actionPerformed(ActionEvent e)
		   {
		    JOptionPane.showMessageDialog(null,"Author  -  geekyCoder\nVersion  -  SudokuSolver 1.0");
		   }
		  });
		  JMenuItem instruction = new JMenuItem("Instructions");
		  instruction.addActionListener(new ActionListener()
		  {
		   public void actionPerformed(ActionEvent e)
		   {
		    JOptionPane.showMessageDialog(null,"INSTRUCTIONS:\n*GENERATOR : Generates a sudoku Problem try to solve it. \n * SOLVER: Solves the sudoku problem given to it");
		   }
		  });
		  
		  help.add(about);
		  help.add(instruction);
		  menu.add(help);
		  frame.setJMenuBar(menu);


	}
}


