-- You must prepend your student username to the `attractions` table.
-- ex. jsmith1_attractions
-- Add all of your columns, data types, and other specifications here.
-- drop table to fully test the data
INSERT INTO users (users, hashed_pass)
VALUES(
    'instructor',
    '$2y$10$THWw/5vy2JemWIF7ukKVxuwCzQMDas9ZPt5sqZI2ks0b2c9vK4Dp2'
  );
DROP TABLE prem_attractions;
-- Create table statement
CREATE TABLE prem_attractions (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(60) NOT NULL,
  media_type VARCHAR(20) NOT NULL,
  release_year INT(4),
  genre1 VARCHAR(20) NOT NULL,
  genre2 VARCHAR(20) NULL,
  starring VARCHAR(250) NOT NULL,
  summary VARCHAR(250) NOT NULL,
  watched INT(1) NOT NULL,
  personal_rating INT(1) NULL,
  streaming_url VARCHAR(200) NOT NULL
);
-- insert statements
INSERT INTO prem_attractions (
    title,
    media_type,
    release_year,
    genre1,
    genre2,
    starring,
    summary,
    watched,
    personal_rating,
    streaming_url
  )
VALUES(
    "The Shawshank Redemption",
    "Movie",
    1994,
    "Thriller",
    "Prison",
    "Tim Robbins,Morgan Freeman,Bob Gunton,William Sadler,Clancy Brown,Gil Bellows,James Whitmore",
    "The film tells the story of banker Andy Dufresne (Tim Robbins), who is sentenced to life in Shawshank State Penitentiary for the murders of his wife and her lover, despite his claims of innocence.",
    0,
    NULL,
    "https://www.crave.ca/en/movies/the-shawshank-redemption"
  ),
  (
    "12 Angry Men",
    "Flim",
    1957,
    "Drama",
    "Crime Friction",
    "Henry Fonda, Lee J. Cobb, Ed Begley, E. G. Marshall, Jack Warden",
    "The film tells the story of a jury of twelve men as they deliberate the conviction or acquittal of a teenager charged with murder on the basis of reasonable doubt",
    1,
    4,
    "https://www.primevideo.com/detail/0R1DYZPH9XC72I479NEXF195HL/ref=atv_dp_share_cu_r"
  ),
  (
    "The Lord of the Rings: The Return of the King",
    "Flim",
    2003,
    "Adventure",
    "Drama",
    "Elijah Wood, Ian McKellen, Liv Tyler, Viggo Mortensen",
    "Gandalf and Aragorn lead the World of Men against Sauron's army to draw his gaze from Frodo and Sam as they approach Mount Doom with the One Ring.",
    0,
    NULL,
    "https://www.primevideo.com/detail/0NSGBFYAQDZQKEC8BBWKT8GILJ/ref=atv_dp_share_cu_r"
  ),
  (
    "Inception",
    "Movie",
    2010,
    "Sci-Fi",
    "Action",
    "Leonardo DiCaprio, Joseph Gordon-Levitt",
    "A thief who steals corporate secrets through the use of dream-sharing technology is given the inverse task of planting an idea into the mind of a CEO.",
    1,
    4,
    "https://www.crave.ca/en/movies/inception"
  ),
  (
    "The Dark Knight",
    "Movie",
    2008,
    "Action",
    "Crime",
    "Christian Bale, Heath Ledger",
    "When the menace known as the Joker emerges from his mysterious past, he wreaks havoc and chaos on the people of Gotham.",
    1,
    5,
    "https://www.crave.ca/fr/movies/the-dark-knight"
  ),
  (
    "Pulp Fiction",
    "Movie",
    1994,
    "Crime",
    "Drama",
    "John Travolta, Uma Thurman",
    "The lives of two mob hitmen, a boxer, a gangster's wife, and a pair of diner bandits intertwine in four tales of violence and redemption.",
    1,
    3.8,
    "https://www.netflix.com/ca/title/880640?source=35"
  ),
  (
    "Forrest Gump",
    "Movie",
    1994,
    "Drama",
    "Romance",
    "Tom Hanks, Robin Wright",
    "The presidencies of Kennedy and Johnson, the Vietnam War, the Watergate scandal, and other historical events unfold through the perspective of an Alabama man with an IQ of 75.",
    1,
    3.2,
    "https://www.primevideo.com/detail/0RMLEUTKD0LKNDHSS10OQNYHF0/ref=atv_dp_share_cu_r"
  ),
  (
    "Fight Club",
    "Movie",
    1999,
    "Drama",
    "Thriller",
    "Brad Pitt, Edward Norton",
    "An insomniac office worker and a devil-may-care soap maker form an underground fight club that evolves into much more.",
    1,
    4,
    "https://www.primevideo.com/detail/0N0CS0LQQGWVRXWT1EI6LATOWB/ref=atv_dp_share_cu_r"
  ),
  (
    "The Matrix",
    "Movie",
    1999,
    "Sci-Fi",
    "Action",
    "Keanu Reeves, Laurence Fishburne",
    "A computer hacker learns from mysterious rebels about the true nature of his reality and his role in the war against its controllers.",
    1,
    4.7,
    "https://www.crave.ca/en/movies/the-matrix"
  ),
  (
    "The Godfather",
    "Movie",
    1972,
    "Crime",
    "Drama",
    "Marlon Brando, Al Pacino",
    "An organized crime dynasty's aging patriarch transfers control of his clandestine empire to his reluctant son.",
    1,
    4.1,
    "https://www.primevideo.com/detail/0L45IM106OK0SH586P7WW9F96I/ref=atv_dp_share_cu_r"
  ),
  (
    "The Silence of the Lambs",
    "Movie",
    1991,
    "Thriller",
    "Crime",
    "Jodie Foster, Anthony Hopkins",
    "A young FBI cadet must confide in an incarcerated and manipulative killer to receive his help on catching another serial killer who skins his victims.",
    1,
    4.5,
    "https://www.crave.ca/en/movies/the-silence-of-the-lambs"
  ),
  (
    "Star Trek",
    "Series",
    1996,
    "Science Friction",
    "Adventure",
    "Chris Pine, Eric Bana, Zoe Saldana",
    "The iconic series 'Star Trek' follows the crew of the starship USS Enterprise as it completes its missions in space in the 23rd century.",
    1,
    5,
    "https://www.primevideo.com/detail/0GVAVIOLWD60ISO04F7CHN38YT/ref=atv_dp_share_cu_r"
  ),
  (
    "The Social Network",
    "Movie",
    2010,
    "Biography",
    "Drama",
    "Jesse Eisenberg, Andrew Garfield, Justin Timberlake",
    "As Harvard students, Mark Zuckerberg and Eduardo Saverin create the social networking site that would become known as Facebook.",
    1,
    4,
    "https://www.crave.ca/en/movies/the-social-network"
  ),
  (
    "The Grand Budapest Hotel",
    "Movie",
    2014,
    "Comedy",
    "Adventure",
    "Ralph Fiennes, F. Murray Abraham, Mathieu Amalric",
    "A writer encounters the former concierge of the Grand Budapest Hotel, who recounts his adventures with a legendary concierge and a priceless painting.",
    1,
    4.5,
    "https://www.primevideo.com/detail/0U43X3DFUCVR8NMOWPVG717A52/ref=atv_dp_share_cu_r"
  ),
  (
    "The Shape of Water",
    "Movie",
    2017,
    "Fantasy",
    "Drama",
    "Sally Hawkins, Octavia Spencer, Michael Shannon",
    "In a hidden high-security government laboratory, a lonely janitor forms a unique relationship with an amphibious creature.",
    0,
    NULL,
    "https://www.primevideo.com/detail/0RIG9NRVJ30X0GSZ4UPF8BP517/ref=atv_dp_share_cu_r"
  ),
  (
    "Parasite",
    "Movie",
    2019,
    "Thriller",
    "Drama",
    "Kang-ho Song, Sun-kyun Lee, Yeo-jeong Jo",
    "Greed and class discrimination threaten the newly formed symbiotic relationship between the wealthy Park family and the destitute Kim clan.",
    1,
    5,
    "https://www.crave.ca/fr/movies/parasite"
  ),
  (
    "The Crown",
    "Series",
    2016,
    "Biography",
    "Drama",
    "Claire Foy, Olivia Colman, Imelda Staunton",
    "Follows the political rivalries and romance of Queen Elizabeth II's reign and the events that shaped the second half of the 20th century.",
    1,
    4.8,
    "https://www.netflix.com/ca/title/80025678"
  ),
  (
    "Breaking Bad",
    "Series",
    2008,
    "Crime",
    "Drama",
    "Bryan Cranston, Aaron Paul, Anna Gunn",
    "A high school chemistry teacher turned methamphetamine manufacturer partners with a former student to secure his family's future.",
    1,
    5,
    "https://www.netflix.com/ca/title/70143836"
  ),
  (
    "The Handmaid's Tale",
    "Series",
    2017,
    "Drama",
    "Sci-Fi",
    "Elisabeth Moss, Yvonne Strahovski, Joseph Fiennes",
    "In a dystopian future, a woman is forced to live as a concubine under a fundamentalist theocratic dictatorship.",
    1,
    4.6,
    "https://www.primevideo.com/detail/0GJ4PLX9NCJKVAGCHSDNMX8N46/ref=atv_dp_share_cu_r"
  ),
  (
    "Stranger Things",
    "Series",
    2016,
    "Horror",
    "Drama",
    "Winona Ryder, David Harbour, Finn Wolfhard",
    "A group of young friends in a small town uncover a series of supernatural mysteries and government conspiracies.",
    1,
    4.9,
    "https://www.netflix.com/ca/title/80057281"
  );