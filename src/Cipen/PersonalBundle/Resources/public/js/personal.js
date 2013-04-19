var option_tree = {
   "Option 1": {"Suboption":200},
   "Option 2": {"Suboption 2": {"Subsub 1":201, "Subsub 2":202},
                "Suboption 3": {"Subsub 3":203, "Subsub 4":204, "Subsub 5":205}
               }
};

$('[data-id="personal"]').optionTree(option_tree);