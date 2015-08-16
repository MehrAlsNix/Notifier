<?php
/**
 * Notifier
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 *
 * @copyright 2015 MehrAlsNix (http://www.mehralsnix.de)
 * @license   http://www.opensource.org/licenses/mit-license.php MIT
 * @link      http://github.com/MehrAlsNix/Notifier
 */

namespace MehrAlsNix\Notifier;

use MehrAlsNix\Notifier\Commands\Available;

/**
 * Class Notification.
 *
 * @package MehrAlsNix\Notifier
 */
abstract class Notification extends Message implements Available
{
    /**
     * @return $this
     *
     * @throws Exception
     */
    public function send()
    {
        if ($this->message === null) {
            throw new Exception(
                'No message set. You have to set one with Message::setMessage()'
                . ' or use Notification::sendMessage(title, msg) instead.'
            );
        }

        $this->notify($this->title, $this->message, realpath($this->icon));

        return $this;
    }

    /**
     * Sends a message.
     * .
     * @param $title
     * @param string $msg
     * @param string $icon optional
     *
     * @return $this
     */
    public function sendMessage($title, $msg, $icon = null)
    {
        $this->notify($title, $msg, is_string($icon) ? $icon : realpath($this->icon));

        return $this;
    }

    /**
     * Notify.
     *
     * @param string $title
     * @param string $message
     * @param string $icon    optional
     *
     * @return mixed
     */
    abstract protected function notify($title, $message, $icon = null);

    /**
     * Executes a shell command.
     *
     * @param string $command
     *
     * @return array|null
     */
    protected function execute($command)
    {
        $status = null;
        $result = array();
        exec($command, $result, $status);
        return !$status ? $result : null;
    }
}
