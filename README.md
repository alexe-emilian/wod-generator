## Rules for WOD generation
- During the program participants get two breaks
- Beginners get four breaks of 1
  minute instead of two
- The program shouldn’t begin or end with breaks
- Beginners should do a maximum of 1 handstand practise during the WOD
- Jumping jacks, jumping rope and short sprints are cardio exercises and should not
  follow after each other
- The gym has limited space for the rings and pull ups, a maximum of 2 participants
  may do either one of these exercises (ring + pull up combined max 2)

## Project overview
### Data structure
- Participant
    - id: unique identifier, also set as index of participants array
    - name
    - beginner: used to determine if the participant is a beginner
    - wod: stores workout-of-the-day elements (`Workout` and `WorkoutBreak`)
- Workout
    - id: unique identifier
    - name
    - category: used to store the `Category` of the workout, such as `Cardio`
- Category
    - id
    - name
- WorkoutBreak: used to determine when the participant takes a break

### Data initialization
- The data with which the participants and workouts are created is set in two separate yaml files
    - `participants.yaml` - contains all the data for the participants
    - `workouts.yaml` - contains all the data for the workouts and their categories
- The classes `ParticipantRepository` and `WorkoutRepository` handle both the initialization and the retrieval of the data
- Having these classes as a separate layer allows us to easily change the source from which we retrieve our data

### WOD generation
- In order to generate the WOD navigate to the root of the project `wod-generator`
- Use the file `exec.php` from the `bin` folder: `php bin/exec.php`
- The method `generate` from the `Generator` class will be called and the WOD generation process will start
- This method retrieves all the participants from the `ParticipantRepository` which was mentioned earlier and generates a WOD for each of them through the method `generate` found on the `WodService`
- This method takes into account the maximum workout time, generates a random workout, and passes all the appropriate data through a chain of responsibility to validate the generated workout
- If the workout passes all the checks in the handlers then it is added into the WOD for the participant
- The breaks are also randomly assigned when this process is done while also taking into account if the participant is a beginner or not
- After all the WOD data is generated an output with the schedule for all the participants is displayed
- Padding was used to aid with the readability of the wod in the `OutputWodService` 

Since the subject of the chain of responsibility and the handlers that were created was only briefly discussed, I'll now go into details explaining why this method of handling the workouts was chosen.

As it can be seen in the `Rules for WOD generation` section of this file, there are quite a few custom rules regarding the order or the amount of workouts that a participant can do.
With a chain of responsibility, each of these rules can be moved into its appropriate handler, allowing us great flexibility when it comes to adding, removing or even changing the rules that we already have.

### Running the tests
Tests have also been added to the project for the classes found in the `Service` and `Handler` directories
Use `vendor/bin/phpunit tests`

