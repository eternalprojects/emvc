import sys

class Main:
	max_height = 5
	max_width = 5
	character_alive = True
	character_won = False
	monster_awake = False
	monster_awakened = False
	monster_move_per_turn = 2
	
	def __init__(self):
		self.display_menu()
		
	def display_menu(self):
		menu_list = ["Start New game", "{Save Game}", "{Load Game}", "Customize Setup", "Exit Game"]
		print("Enter a number from below:")
		for i in range(1, len(menu_list) + 1):
			print(str(i) + ' ' + menu_list[i - 1])
		choice = input("Your choice: ")
		self.menu_choice(choice)
	
	def menu_choice(self, choice):
		try:
			choice = int(choice)
		except ValueError:
			choice = 0
		
		if(choice == 1):
			pass
		elif(choice == 2):
			pass
		elif(choice == 3):
			pass
		elif(choice == 4):
			pass
		elif(choice == 5):
			sys.exit(0)
		else:
			print("That was not a valid option.  Please try again.")
			self.display_menu()
			
	def draw_grid(self):
		height = self.max_height
		width = self.max_width
	

monster = Main()
